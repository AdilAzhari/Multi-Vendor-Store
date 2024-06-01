(function ($) {
    $(".item-quantity").on("change", function () {
        $.ajax({
            url: "/cart/" + $(this).data("id"),
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
        });
    });
})(jQuery);
