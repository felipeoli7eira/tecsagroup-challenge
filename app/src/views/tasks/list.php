<div class="row m-0 p-5">
    <div class="row m-0 p-0 d-flex justify-content-center">
        <div class="col m-0 col-12 col-md-6">
            <ul class="nav nav-pills mb-3" id="pills-tab">
                <li class="nav-item">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#do-tab-pane" type="button" aria-controls="do-tab-pane" aria-selected="true">A fazer</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#doing-tab-pane" type="button" aria-controls="doing-tab-pane" aria-selected="false">Fazendo</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#done-tab-pane" type="button" aria-controls="done-tab-pane" aria-selected="false">Finalizadas</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- do panel -->
                <div class="tab-pane fade show active" id="do-tab-pane" aria-labelledby="home-tab" tabindex="0">
                    <table class="table p-0 m-0 table-hover" id="table-list-do-tasks">
                        <thead>
                            <tr>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Mudar status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <!-- doing panel -->
                <div class="tab-pane fade" id="doing-tab-pane" aria-labelledby="profile-tab" tabindex="0">
                    <table class="table p-0 m-0 table-hover" id="table-list-doing-tasks">
                        <thead>
                            <tr>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Mudar status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="done-tab-pane" aria-labelledby="contact-tab" tabindex="0">
                    <table class="table p-0 m-0 table-hover" id="table-list-done-tasks">
                        <thead>
                            <tr>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Mudar status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/modules/task/list.js" type="module"></script>
