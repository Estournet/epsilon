$(document).ready(function () {
    $(function () {
        $('#connexion_link').click(function (e) {
            $("#connexion_form").delay(100).fadeIn(100);
            $("#inscription_form").fadeOut(100);
            e.preventDefault();
        });
        $('#inscription_link').click(function (e) {
            $("#inscription_form").delay(100).fadeIn(100);
            $("#connexion_form").fadeOut(100);
            e.preventDefault();
        });

    });

// **********************************************************
    /* show file value after file select */
    $('.custom-file-input').on('change', function () {
        $(this).next('.form-control-file').addClass("selected").html($(this).val());
    });

// **********************************************************
    $("form#addToCart").submit(function () {
        //Poste le formulaire sérialisé au script PHP
        $.post('scripts/add_to_cart.php', $(this).serialize());
        $('.modal').modal('hide');

        //TODO Mettre un titre aléatoire à la notification
        // var title = ["Yes !", "Oui !", "Super", "Parfait"];

        $.notify({
            title: '<strong>Yes !</strong>',
            message: 'Vous avez bien ajouté cet article à votre panier'
        }, {
            type: 'success',
            allow_dismiss: true,
            placement: {
                from: "top",
                align: "center"
            },
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            z_index: 2000,
            delay: 1000
        });
    });
});