<div class="d-flex justify-content-center row m-0">
    <form class="p-5 col col-12 col-md-3" name="createForm">
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
                    id="title" />
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
                    id="description" />
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-12 col-md-2 d-flex justify-content-start align-items-center p-0">
                <label for="status" class="form-label m-0">Status <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-md-10 p-0">
                <select class="form-control" name="status" id="status">
                    <option value="do">Fazer</option>
                    <option value="doing">Fazendo</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary fw-semibold">Cadastrar</button>
        </div>
    </form>
</div>


<script src="/modules/task/create.js" type="module"></script>
