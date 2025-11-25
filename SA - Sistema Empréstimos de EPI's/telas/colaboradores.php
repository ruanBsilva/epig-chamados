<div class="colaboradores-container">
    <div class="colaboradores-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gerenciamento de Colaboradores</h1>
        <button class="btn btn-primary new-user-btn" type="button" data-bs-toggle="modal" data-bs-target="#meuModal" onclick='abrirModalNovo()'>
            <i class="bi bi-plus-lg me-2"></i> Novo Colaborador
        </button>
    </div>
    <p class="text-muted mb-4">Gerencie os colaboradores da empresa e seus dados</p>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 card-stats-row">
        <div class="col">
            <div class="card card-stat total-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Total</h6>
                        <i class="bi bi-people-fill fs-5"></i>
                    </div>
                    <div class="stat-value">4</div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card card-stat admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Ativos</h6>
                        <i class="bi bi-person-check-fill fs-5"></i>
                    </div>
                    <div class="stat-value">1</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat operador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Sem EPIs</h6>
                        <i class="bi bi-person-x-fill fs-5"></i>
                    </div>
                    <div class="stat-value">2</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat visualizador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Com EPIs</h6>
                        <i class="bi bi-shield-shaded fs-5"></i>
                    </div>
                    <div class="stat-value">3</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 user-table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">EPIs Ativos</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 15%; text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-Colaborador">
                        </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Colaboradores Cadastrados</small>
            <small class="text-muted" id="qtd_colaboradores"></small>
        </div>
    </div>

    <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content new-user-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="TituloModalCentralizado">Cadastrar Colaborador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="fecharModal()"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="text-muted">Preencha os dados pessoais e profissionais do colaborador</p>

                    <form id="form-colaborador" onsubmit="return false">
                        <div class="row mb-3">
                            <div class="col-md-2 mb-3">
                                <label for="txt-id-colaborador" class="form-label">ID</label>
                                <input class="form-control" type="text" id="txt-id-colaborador" value="NOVO" readonly required>
                            </div>
                            <div class="col-md-10 mb-3">
                                <label for="txt-nome-colaborador" class="form-label">Nome Completo</label>
                                <input class="form-control" type="text" id="txt-nome-colaborador" placeholder="Ex: João da Silva" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="cpf-colaborador" class="form-label">CPF</label>
                                <input class="form-control" type="text" id="cpf-colaborador" placeholder="000.000.000-00" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data-nasc-colaborador" class="form-label">Data de Nascimento</label>
                                <input class="form-control" type="date" id="data-nasc-colaborador" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="txt-email-colaborador" class="form-label">Email</label>
                                <input class="form-control" type="email" id="txt-email-colaborador" placeholder="email@empresa.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="txt-telefone-colaborador" class="form-label">Telefone</label>
                                <input class="form-control" type="text" id="txt-telefone-colaborador" placeholder="(00) 00000-0000" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="txt-cargo" class="form-label">Cargo</label>
                                <input class="form-control" type="text" id="txt-cargo" placeholder="Ex: Soldador" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-cancel" onclick="fecharModal()" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-dark btn-create-user" onclick="salvarColaboradores()">Salvar Colaborador</button>
                </div>
            </div>
        </div>
    </div>
</div>