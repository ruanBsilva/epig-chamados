<div class="equipamentos-container">
    <div class="equipamentos-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gerenciamento de Empréstimos de EPI</h1>
        <button class="btn btn-primary new-user-btn" type="button" data-bs-toggle="modal" data-bs-target="#novoEmprestimoModal">
            <i class="bi bi-plus-lg me-2"></i> Novo Empréstimo 
        </button>
    </div>
    <p class="text-muted mb-4">Gerencie todos os empréstimos e devoluções de EPIs</p>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 card-stats-row">
        <div class="col">
            <div class="card card-stat total-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Ativos</h6>
                        <i class="bi bi-arrow-down-up fs-5"></i> </div>
                    <div id="qtd-ativos" class="stat-value"></div>
                </div>
            </div>
        </div> 
        <div class="col">
            <div class="card card-stat admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Vencidos</h6>
                        <i class="bi bi-exclamation-diamond-fill text-danger fs-5"></i> </div>
                    <div id="qtd-vencidos" class="stat-value"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-stat operador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">A Vencer</h6>
                        <i class="bi bi-clock-fill fs-5"></i> </div>
                    <div id="qtd-a-vencer" class="stat-value"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-stat visualizador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Total (Histórico)</h6>
                        <i class="bi bi-list-check fs-5"></i> </div>
                    <div id="qtd-total-emprestimos" class="stat-value"></div>
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
                            <th scope="col" style="width: 5%;">Id</th>
                            <th scope="col" style="width: 15%;">Colaborador</th>
                            <th scope="col" style="width: 20%;">Equipamento</th>
                            <th scope="col" style="width: 10%;">Empréstimo</th>
                            <th scope="col" style="width: 10%;">Previsão Dev.</th>
                            <th scope="col" style="width: 10%;">Devolução</th>
                            <th scope="col" style="width: 15%;">Status</th>
                            <th scope="col" style="width: 15%; text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-emprestimos">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Registros de Empréstimos de EPI</small>
            <small class="text-muted" id='qtd_emprestimos'></small>
        </div>
    </div>
    <div class="modal fade" id="novoEmprestimoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content new-user-modal-content"> 
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="novoEmprestimoModalLabel">Novo Empréstimo de EPI</h5> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="text-muted">Registre um novo empréstimo de equipamento para um colaborador</p>
                    <form id="form-emprestimo" onsubmit="return false">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="list-colaborador" class="form-label">Colaborador</label>
                                <select class="form-select" id="list-colaborador" required>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="list-equipamento" class="form-label">Equipamento</label>
                                <select class="form-select" id="list-equipamento" required>
                                    
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data-emprestimo" class="form-label">Data do Empréstimo</label>
                                <input class="form-control" type="date" id="data-emprestimo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data-prev-devolucao" class="form-label">Previsão Devolução</label>
                                <input class="form-control" type="date" id="data-prev-devolucao" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt-obs" class="form-label">Observações</label>
                                <textarea class="form-control" id="txt-obs" rows="3" placeholder="Informações adicionais sobre o empréstimo"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button onclick="salvarEmprestimo()" class="btn btn-dark btn-create-user">Registrar Empréstimo</button>
                </div>
            </div>
        </div>
    </div>
</div>