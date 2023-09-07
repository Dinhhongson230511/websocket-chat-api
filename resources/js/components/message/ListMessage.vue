<script setup>
  import InfiniteLoading from "v3-infinite-loading";
  import "v3-infinite-loading/lib/style.css"; //required if you're not going to override default slots
</script>
<template>
  <div>
    <div id="msg-history" class="msg-history">
      <infinite-loading
        direction="top"
        @infinite="infiniteHandler"
        force-use-infinite-wrapper=".msg-history"
        class="show-infinite-loading"
      >
      </infinite-loading>
      <div
        :class="{
          'incoming-msg': msg.user_id !== user.id,
          'outgoing-msg': msg.user_id === user.id,
        }"
        v-for="(msg, index) in messages"
        :key="index"
      >
        <div class="item">
          <div class="item-header">
            <div class="item-avatar" v-if="msg.user_id !== user.id">
              <img :src="msg.avatar ? msg.avatar : 'https://ptetutorials.com/images/user-profile.png'" alt="user-profile" />
            </div>
            <div v-if="msg.user_id !== user.id" class="item-name">
              {{ msg.name }}
            </div>
            <div v-if="msg.user_id === user.id" class="item-name">
              {{ msg.name }}
            </div>
            <div class="item-name" v-if="msg.isCompanyUser">
              (担当者)
            </div>
            <div class="item-date">&nbsp; {{ formatDat(msg.created_at) }}</div>
          </div>
          <div class="item-content">
            <template v-for="p in msg.msgs">
              <p v-if="p.type === 'message'" :key="p.id">{{ p.message }}</p>
              <template v-if="p.type === 'images'">
                <p v-for="(img, index) in p.images" :key="`${img}-${index}`">
                  <img :src="img" class="message-image" />
                </p>
              </template>
              <p v-if="p.type === 'attachments'" :key="p.id">
                <a
                  v-for="(att, index) in p.attachments"
                  :key="`${att}-${index}`"
                  :href="att.url"
                  target="_blank"
                  ><i class="fas fa-file"></i> {{ att.name }}</a
                >
              </p>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["channel", "url", "url_update_read"],
  data() {
    return {
      messages: [],
      user: {},
      page: 1,
    };
  },
  mounted: function () {
    this.scrollMessage();
  },
  created() {
    window.echo
      .private(`chat-${this.channel.id}`)
      .listen("MessageSent", (e) => {
        const lastIndex = this.messages.length - 1;
        if (
          this.messages.length <= 0 ||
          e.user.id !== this.messages[lastIndex].user_id
        ) {
          this.messages.push({
            created_at: e.message.created_at,
            name: e.userChatting,
            user_id: e.user.id,
            msgs: [e.message],
            isCompanyUser: e.message.isCompanyUser
          });
        } else {
          this.messages[lastIndex].msgs.push(e.message);
        }
        this.scrollMessage();
        axios.get(this.url_update_read);
      });
  },
  methods: {
    formatDat(date) {
      return moment(date).calendar(null, {
        sameDay: "hh:mm A  | [今日]",
        nextDay: "hh:mm A  | [明日]",
        nextWeek: "hh:mm A  | YYYY/MM/DD",
        lastDay: "hh:mm A  | [昨日]",
        lastWeek: "hh:mm A  | YYYY/MM/DD",
        sameElse: "hh:mm A  | YYYY/MM/DD",
      });
    },
    infiniteHandler($state) {
      axios
        .get(this.url, {
          params: {
            page: this.page,
          },
        })
        .then(({ data }) => {
          this.messages.unshift(...data.messages);
          this.user = data.user;
          this.page += 1;
          if (data.last_page >= data.current_page) {
            $state.loaded();
          } else {
            $state.complete();
            this.scrollMessage();
          }
          // $('.show-infinite-loading').text('');
        });
    },
    scrollMessage() {
      setTimeout(() => {
        this.scrollHeight();
      }, 1000);
    },
    scrollHeight() {
      let sc = document.getElementById("msg-history");
      if(sc != null) {
        sc.scrollTop = sc.scrollHeight - sc.clientHeight;
      }
    },
  },
};
</script>
