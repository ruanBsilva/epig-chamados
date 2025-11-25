<div class="emprestimos-container">
    <div class="emprestimos-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gerenciamento de Empréstimos</h1>
        <button class="btn btn-primary new-user-btn" type="button" data-bs-toggle="modal" data-bs-target="#ModalEmprestimos">
            <i class="bi bi-plus-lg me-2"></i> Novo Empréstimo
        </button>
    </div>
    <p class="text-muted mb-4">Controle de entrega e devolução de EPIs</p>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 card-stats-row">
        <div class="col">
            <div class="card card-stat total-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Empréstimos Ativos</h6>
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </div>
                    <div class="stat-value">4</div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card card-stat admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Vencidos</h6>
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    </div>
                    <div class="stat-value">1</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat operador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">A vencer</h6>
                        <i class="bi bi-clock-history fs-5"></i>
                    </div>
                    <div class="stat-value">2</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat visualizador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Total Histórico</h6>
                        <i class="bi bi-archive-fill fs-5"></i>
                    </div>
                    <div class="stat-value">7</div>
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
            <small class="text-muted">Registros de Empréstimos</small>
            <small class="text-muted" id='qtd_emprestimos'></small>
        </div>
    </div>

    <div class="modal fade" id="ModalEmprestimos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content new-user-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="TituloModalCentralizado">Novo Empréstimo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="fecharModal()"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="text-muted">Selecione o colaborador, o equipamento e a quantidade</p>
                    
                    <form id="form-emprestimos" onsubmit="return false">
                        <input type="hidden" id="txt-id-emprestimo" value="NOVO" readonly>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="list-colaborador" class="form-label">Colaborador</label>
                                <select class="form-select" id="list-colaborador">
                                    </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 mb-3">
                                <label for="list-equipamento" class="form-label">Equipamento</label>
                                <select class="form-select" id="list-equipamento">
                                    </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="txt-qtd" class="form-label">Qtd.</label>
                                <input type="number" class="form-control" id="txt-qtd" min="1" value="1" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="data-emprestimo" class="form-label">Data do empréstimo</label>
                                <input class="form-control" type="date" id="data-emprestimo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data-prev-devolucao" class="form-label">Previsão de Devolução</label>
                                <input class="form-control" type="date" id="data-prev-devolucao" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="txt-obs" class="form-label">Observações</label>
                            <textarea class="form-control" id="txt-obs" rows="3" placeholder="Informações adicionais sobre o estado do equipamento ou condições..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-cancel" onclick="fecharModal()" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-dark btn-create-user" onclick="salvarEmprestimo()">Salvar Empréstimo</button>
                </div>
            </div>
        </div>
    </div>
</div>