$(document).ready(function () {
    // Handle change travel agency
    $('#agency').on('change', function () {
        var selectedAgency = $(this).val();
        var customerSelect = $('#customer');

      // Make an AJAX request to fetch customers based on the selected agency
        $.ajax({
            url: getCustomersByAgency,
            type: 'GET',
            data: { agency: selectedAgency },
            dataType: 'json',
            success: function (data) {
              // Clear existing options and add new customer options
                customerSelect.empty();
                customerSelect.prop('disabled', false);
                customerSelect.append($('<option></option>').attr('value', "").text(""));
                $.each(data.customers, function (key, value) {
                    customerSelect.append($('<option></option>').attr('value', key).text(value));
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Handle change customer
    $('#customer').on('change', function () {
        var selectedCustomer = $(this).val();
        $.ajax({
            url: getCustomerPeople,
            type: 'GET',
            data: { customer: selectedCustomer },
            dataType: 'json',
            success: function (data) {
              // Show the total of persons in current customer
                $('#customerPeople').text(data.people);
                $('#numberOfPeople').val(data.people);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Handle change store
    $('#store').on('change', function () {
        $('#specialFood').hide();
        var selectedStore = $(this).val();

        var mainSetMenu = $('#mainSetMenu');
        var subSetMenu = $('#subSetMenu');
        var drinkSetMenu = $('#drinkSetMenu');

      // Make an AJAX request to fetch store set menu list
        $.ajax({
            url: getFoodMenusByStore,
            type: 'GET',
            data: { store: selectedStore },
            dataType: 'json',
            success: function (data) {
                mainSetMenu.empty();
                subSetMenu.empty();
                drinkSetMenu.empty();
                mainSetMenu.append($('<option></option>').attr('value', "").text(""));
                subSetMenu.append($('<option></option>').attr('value', "").text(""));
                drinkSetMenu.append($('<option></option>').attr('value', "").text(""));
                $.each(data.foods, function (key, value) {
                    if (value.food_type_id === 1) {
                        mainSetMenu.append($('<option></option>').attr('value', value.id).text(value.name));
                    } else if (value.food_type_id === 2) {
                        drinkSetMenu.append($('<option></option>').attr('value', value.id).text(value.name));
                    } else if (value.food_type_id === 3) {
                        subSetMenu.append($('<option></option>').attr('value', value.id).text(value.name));
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Handle change main set menu
    $('#mainSetMenu').on('change', function () {
        var selectedFood = $(this).val();

      // Display the main set menu food
        $.ajax({
            url: getFoodInfo,
            type: 'GET',
            data: { food: selectedFood },
            dataType: 'json',
            success: function (data) {
                $('#specialFood').css('display', 'block');
                var foodImages = data.food.food_images;
                $('#mainFoodImage').hide();
                if (foodImages.length) {
                    const mainImage = foodImages.find(item => item.type === 1);
                    $('#mainFoodImage').toggle(!!mainImage).attr('src', mainImage?.source_url);
                }

                $('#specialFood .special_food--title .value').html(data.food.name);
                $('#specialFood .special_food--desc .value').html(data.food.content);
                $('#specialFood .special_food--fee').html(data.food.fee + yen);

                if (parseInt($('#numberOfPeople').val()) > parseInt(data.food.fee)) {
                    $('#numberOfPeople').next().after('<span class="invalid-feedback d-block"><strong>' + '❖最大受入人数を超えています' + '</strong></span>');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Handle change submenu
    $('#subSetMenu').on('change', function () {

        $('#subMenuContainer').empty();
        var selectedOptions = $(this).find(':selected');

        selectedOptions.each(function () {
            var selectedFood = $(this).val();

            var clone = $('#cloneSubMenu').clone().removeAttr('id').show();
            $('#subMenuContainer').append(clone);

            $.ajax({
                url: getFoodInfo,
                type: 'GET',
                data: { food: selectedFood },
                dataType: 'json',
                success: function (data) {
                    clone.find('.special_food--title .value').html(data.food.name);
                    clone.find('.special_food--desc .value').html(data.food.content);
                    clone.find('.special_food--fee').html(data.food.fee + yen);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    // Handle change submenu
    $('#drinkSetMenu').on('change', function () {

        $('#drinkMenuContainer').empty();
        var selectedOptions = $(this).find(':selected');

        selectedOptions.each(function () {
            var selectedFood = $(this).val();

            var clone = $('#cloneDrinkMenu').clone().removeAttr('id').show();
            $('#drinkMenuContainer').append(clone);

            $.ajax({
                url: getFoodInfo,
                type: 'GET',
                data: { food: selectedFood },
                dataType: 'json',
                success: function (data) {
                    clone.find('.special_food--title .value').html(data.food.name);
                    clone.find('.special_food--desc .value').html(data.food.content);
                    clone.find('.special_food--fee').html(data.food.fee + yen);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

  // Handle submit confirm reservation
    $('#confirmReservation').on('click', function (event) {
        event.preventDefault();

        var form = $('#formCreateReservation');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                form.find('input, select, textarea').prop('disabled', true);
                $('.invalid-feedback').remove();
                $('#confirmReservation').hide();
                $('.confirm-buttons').css('display', 'block');

              // Store the validated data in a hidden input
                $('<input>').attr({
                    type: 'hidden',
                    name: 'validated_data',
                    value: JSON.stringify(data.data)
                }).appendTo(form);
                drawTotalPrice(data.data);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                  // Clear previous error messages
                    $('.invalid-feedback').remove();

                  // Display validation errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        $.each(messages, function (key, message) {
                            if (input.is('input')) {
                                input.after('<span class="invalid-feedback d-block"><strong>' + message + '</strong></span>');
                            } else {
                                input.next().after('<span class="invalid-feedback d-block"><strong>' + message + '</strong></span>');
                            }
                        });
                    });
                    var highestErrorInput = $('.invalid-feedback').first();
                    var offset = highestErrorInput.offset().top - 100;
                    $('html').animate({ scrollTop: offset }, 500);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });

    //Handle save reservation
    $('#saveReservation').on('click', function (event) {
        event.preventDefault();

        var form = $('#formCreateReservation');
        var parsedData = JSON.parse(form.find('input[name="validated_data"]').val());

        $.ajax({
            url: storeReservations,
            type: 'POST',
            data: parsedData,
            dataType: 'json',
            success: function (data) {
                window.location.href = `${listReservations}?show_success_message=true`;
            },
            error: function (xhr) {
                toastr.error(data.message);
            }
        });
    });

  //Handle back reservation
    $('#backReservation').on('click', function (event) {
        event.preventDefault();

        var form = $('#formCreateReservation');
        form.find('input, select, textarea').prop('disabled', false);
        $(".payment-fee").hide();
        $('.confirm-buttons').css('display', 'none');
        $('#confirmReservation').show();
    });

    // Handle show the d_g meals form
    $('input#have_d_g_meals').click(function () {
        $('#dgMeal').show();
    });

    // Hide the d_g meals form
    $('input#no_d_g_meals').click(function () {
        $('#dgMeal').hide();

      // Clear the input
        $('[name="number_separate_meal"]').val('')
        $('[name="number_meal_together"]').val('')
        $('[name="number_takeout_separate_dining"]').val('')
        $('[name="number_dining_together"]').val('')
        $("#total_d_g_meal").html('')
    });

    // Calculate the sum of dg meal
    var input1 = $('[name="number_meal_together"]');
    var input2 = $('[name="number_dining_together"]');
    var resultSpan = $("#total_d_g_meal");
    input1.on("input", updateSum);
    input2.on("input", updateSum);
    function updateSum()
    {
        var num1 = parseFloat(input1.val()) || 0;
        var num2 = parseFloat(input2.val()) || 0;
        var sum = num1 + num2;
        resultSpan.text(sum);
    }

    function setStateSelectPayment(elm, state)
    {
        if (state) {
            $(elm).attr('style', 'display: block !important');
        } else {
            $(elm).attr('style', 'display: none !important');
        }
    }
    setStateSelectPayment('#box_payment_method_cp', false)
    setStateSelectPayment('#box_payment_drink_cp', false)
    setStateSelectPayment('#box_payment_method_on_day_cp', false)

    $("#payment_method").on("change", function (e) {
        const { value } = e.target;
        const state = value === 'cp_invoice_issued' ||
        value === 'cp_bring_on_the_day';
        setStateSelectPayment('#box_payment_method_cp', state)
    })
    $("#payment_drink").on("change", function (e) {
        const { value } = e.target;
        const state = value === 'cp_ticket_at_a_later_date' ||
        value === 'cp_bring_on_the_day';
        setStateSelectPayment('#box_payment_drink_cp', state)
    })
    $("#payment_method_on_day").on("change", function (e) {
        const { value } = e.target;
        const state = value === 'cp_bring_on_the_day' ||
        value === 'cp_ticket_at_a_later_date';
        setStateSelectPayment('#box_payment_method_on_day_cp', state)
    })

    function drawFoodList(groupClass, foodList, food_type_id)
    {
        const foods = foodList.filter((food) => food.food_type_id == food_type_id);
        foods.forEach((food, index) => {
            const { number_people, fee, name } = food;
            if (index > 0) {
                const lastSelector = $(`${groupClass}`).eq(index - 1);
                lastSelector.parent().append(lastSelector.prop("outerHTML"))
            }
            $(`${groupClass}`).eq(index).find(".p_number_people").html(formatPrice(+number_people));
            $(`${groupClass}`).eq(index).find(".p_name").html(name);
            $(`${groupClass}`).eq(index).find(".p_fee").html(formatPrice(fee));
            $(`${groupClass}`).eq(index).find(".p_total").html(formatPrice(+fee * +number_people));
        })
    }

    function drawTotalPrice(data)
    {
        $(".payment-fee").show();
        const { data_foods } = data;
        drawFoodList(".preview_main_menu", data_foods, 1);
        drawFoodList(".preview_sub_menu", data_foods, 3);
        drawFoodList(".preview_drink", data_foods, 2);
    }
});
