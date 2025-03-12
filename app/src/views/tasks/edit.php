<div class="d-flex justify-content-center row m-0">
    <form class="p-5 col col-12 col-md-3" name="updateTaskForm">
        <div class="row mb-5">
            <p class="m-0 p-0">O status atual da tarefa é "<b><?= $data->friendlyStatus ?></b>".</p>
            <p class="m-0 p-0">Você pode mudar para um diferente deste.</p>
        </div>

        <div class="mb-3 row">
            <div class="col-12 col-md-2 d-flex justify-content-start align-items-center p-0">
                <label for="title" class="form-label m-0">Nome <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-md-10 p-0">
                <input
                    type="text"
                    class="form-control"
                    placeholder="..."
                    name="title"
                    id="title"
                    value="<?= $data->title ?>" />
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-12 col-md-2 d-flex justify-content-start align-items-center p-0">
                <label for="description" class="form-label m-0">Descrição <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-md-10 p-0">
                <input
                    type="text"
                    class="form-control"
                    placeholder="..."
                    name="description"
                    value="<?= $data->description ?>"
                    id="description" />
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-12 col-md-2 d-flex justify-content-start align-items-center p-0">
                <label for="status" class="form-label m-0">Status <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-md-10 p-0">
                <select class="form-control" name="status" id="status">
                    <?php if ($data->status !== 'do'): ?>
                        <option value="do">Fazer</option>
                    <?php endif ?>

                    <?php if ($data->status !== 'doing'): ?>
                        <option value="doing">Fazendo</option>
                    <?php endif ?>

                    <?php if ($data->status !== 'done'): ?>
                        <option value="doing">Feito</option>
                    <?php endif ?>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary fw-semibold">Atualizar</button>
        </div>
    </form>
</div>

<script src="/modules/task/create.js" type="module"></script>
