<?php
$pageTitle = "Login";
include 'app/views/templates/header.php';
?>

<div class="container">
    <h2>Login</h2>
    <form id="loginForm">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<script>
$(document).ready(function() {
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
});
</script>

<?php include 'app/views/templates/footer.php'; ?>
