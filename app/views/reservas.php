<?php
$pageTitle = "Reservas";
include 'app/views/templates/header.php';
?>

<div class="container">
    <h2>Reservas de Salas</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addReservaModal">Adicionar Reserva</button>
    <button class="btn btn-secondary" onclick="logout()">Logout</button>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Sala</th>
                <th>Data</th>
                <th>Horário de Início</th>
                <th>Horário de Fim</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
            <tr>
                <td><?php echo htmlspecialchars($reserva['sala']); ?></td>
                <td><?php echo htmlspecialchars($reserva['data']); ?></td>
                <td><?php echo htmlspecialchars($reserva['horario_inicio']); ?></td>
                <td><?php echo htmlspecialchars($reserva['horario_fim']); ?></td>
                <td><?php echo htmlspecialchars($reserva['descricao']); ?></td>
                <td>
                    <button class="btn btn-danger" onclick="deleteReserva(<?php echo $reserva['id']; ?>)">Deletar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addReservaModal" tabindex="-1" role="dialog" aria-labelledby="addReservaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReservaModalLabel">Adicionar Reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addReservaForm">
                    <div class="form-group">
                        <label for="id_sala">Sala:</label>
                        <input type="text" class="form-control" id="id_sala" name="id_sala" required>
                    </div>
                    <div class="form-group">
                        <label for="data">Data:</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_inicio">Horário de Início:</label>
                        <input type="time" class="form-control" id="horario_inicio" name="horario_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_fim">Horário de Fim:</label>
                        <input type="time" class="form-control" id="horario_fim" name="horario_fim" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
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
});

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
</script>

<?php include 'app/views/templates/footer.php'; ?>
