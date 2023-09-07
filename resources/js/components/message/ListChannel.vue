<template>
  <div class="chat-list">
    <div class="row">
        <div class="col-xl-12 col-lg-8 pl-0 mb-2">
          <button type="button" ref="ALL" @click="searchData('ALL')" class="btn active-btn btn-secondary text-uppercase ms-2">すべて</button>
          <button type="button" ref="ORDER" @click="searchData('ORDER')" class="btn btn-secondary text-uppercase ms-2">自分</button>
          <button type="button" ref="PERSONAL" @click="searchData('PERSONAL')" class="btn btn-secondary text-uppercase ms-2">予約前</button>
        </div>
        <div class="col-xl-12 col-lg-8 pl-0 mb-2">
          <div class="input-group">
            <input ref="search-text" type="text" @input="handleInput" class="form-control" placeholder="店舗名, 団体" aria-label="Recipient's username with two button addons">
            <button class="btn btn-primary" type="button" @click="searchChannels">検索</button>
          </div>
        </div>
    </div>
    <a :href="c.url" v-for="c in dataChannel.channels" :key="c.id">
      <div
        v-bind:class="{
          'item-active': c.channel_id === dataChannel.channel.id,
          item: true,
        }"
      >
        <div class="item-avatar">
          <div class="item-pic">
            <template v-for="(user, index) in c.users">
              <img
                v-if="index < 2"
                :key="`${c.id}-${index}`"
                :src="user.avatar"
                alt="avatar"
                :class="`img-${index + 1}`"
              />
            </template>
          </div>
        </div>
        <div class="item-content">
          <div class="item-content-title">
            <h5>
              {{ c.name }}
              <span class="chat-date" v-if="c.msg">{{
                formatDat(c.msg.created_at)
              }}</span>
            </h5>
          </div>
          <div class="item-content-excerpt" v-if="c.msg">
            {{ c.msg.message }}
          </div>
        </div>
        <div class="item-status">
          <p
            class="seen"
            v-if="c.channel_id === channel.id || c.msg_count === 0"
          >
            <img width="24" src="/assets/images/double-tick.png" />
          </p>
          <p
            class="notseen"
            v-if="c.channel_id !== channel.id && c.msg_count !== 0"
          >
            {{ `${c.channel_id === channel.id ? 0 : c.msg_count}` }}
          </p>
        </div>
      </div>
    </a>
  </div>
</template>
<script>
export default {
  props: [],
  data() {
    return {
      dataChannel: [],
      loading: true,
      channel: JSON.parse(window.config.channel) || {},
      search: "ALL",
      searchType: "searchType",
    };
  },
  created() {
    this.pullData();
    setInterval(() => {
      this.pullData();
    }, 15000);
  },
  methods: {
    async pullData() {
      const params = {
        search: this.search,
        searchType: this.searchType
      };
      const data = await axios.get(config.urlLeft, {
        params: params
      });
      this.loading = false;
      this.dataChannel = data.data;
    },
    formatDat(date) {
      return window.moment(date).format("MMM DD");
    },
    searchData(search) {
      this.$refs["search-text"].value = "";
      this.search = search;
      this.searchType = 'searchType';
      if(search === "ALL") {
        this.$refs[search].classList.add('active-btn');
        this.$refs["PERSONAL"].classList.remove('active-btn')
        this.$refs["ORDER"].classList.remove('active-btn');
      }
      if(search === "PERSONAL") {
        this.$refs[search].classList.add('active-btn');
        this.$refs["ALL"].classList.remove('active-btn')
        this.$refs["ORDER"].classList.remove('active-btn');
      }
      if(search === "ORDER") {
        this.$refs[search].classList.add('active-btn');
        this.$refs["PERSONAL"].classList.remove('active-btn')
        this.$refs["ALL"].classList.remove('active-btn');
      }
      this.pullData();
    },
    handleInput(event) {
      this.search = event.target.value;
    },
    searchChannels() {
      this.searchType = 'searchText';
      this.pullData();
    }
  },
};
</script>
