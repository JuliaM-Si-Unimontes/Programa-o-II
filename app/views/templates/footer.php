<footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">© 2024 Sistema de Reservas de Salas</span>
        </div>
    </footer>
</div>
<script>
    function logout() {
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=home&action=logout',
            success: function(response) {
                window.location.href = 'index.php';
            }
        });
    }
</script>
</body>
</html>
