<div class="row m-0 p-3 p-lg-5">
    <form class="col col-12 col-lg-5 offset-lg-3" name="createForm">
        <div class="mb-3 row">
            <div class="col-12 col-lg-2 mb-2 mb-lg-0 d-flex justify-content-start align-items-center p-0">
                <label for="title" class="form-label m-0">Nome <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-lg-10 p-0">
                <input
                    type="text"
                    class="form-control"
                    placeholder="..."
                    name="title"
                    id="title"
                    maxlength="255" />
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-12 col-lg-2 mb-2 mb-lg-0 d-flex justify-content-start align-items-center p-0">
                <label for="description" class="form-label m-0">Descrição <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-lg-10 p-0">
                <input
                    type="text"
                    class="form-control"
                    placeholder="..."
                    name="description"
                    id="description"
                    maxlength="255" />
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-12 col-lg-2 mb-2 mb-lg-0 d-flex justify-content-start align-items-center p-0">
                <label for="status" class="form-label m-0">Status <span class="text-danger fw-bold">*</span></label>
            </div>

            <div class="col-12 col-lg-10 p-0">
                <select class="form-control" name="status" id="status">
                    <option value="do">Fazer</option>
                    <option value="doing">Fazendo</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="p-0 d-flex justify-content-end gap-3">
                <a href="/" class="btn fw-semibold">Voltar</a>
                <button type="submit" class="btn btn-primary fw-semibold">Cadastrar</button>
            </div>
        </div>
    </form>
</div>


<script src="/modules/task/create.js" type="module"></script>
