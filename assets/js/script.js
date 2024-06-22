$(document).ready(function() {

    // Script para adicionar nova reserva
    $('#addReservaForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php?controller=reserva&action=create',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.message === "Reserva criada com sucesso.") {
                    location.reload();
                }
            }
        });
    });

    // Script para deletar reserva
    function deleteReserva(id) {
        if (confirm("Tem certeza que deseja deletar esta reserva?")) {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=reserva&action=delete',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.message === "Reserva deletada com sucesso.") {
                        location.reload();
                    }
                }
            });
        }
    }

    // Script para realizar o login
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php?controller=home&action=login',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.message === "Login bem-sucedido.") {
                    window.location.href = 'index.php?controller=reserva&action=index';
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Script para realizar o logout
    function logout() {
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=home&action=logout',
            success: function(response) {
                window.location.href = 'index.php';
            }
        });
    }

});
