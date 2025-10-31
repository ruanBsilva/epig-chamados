<h3>Gerador de Código de Barras com AJAX</h3>

<div>
    <label for="txt-dado-codigo">Texto para o Código de Barras:</label>
    <input type="text" id="txt-dado-codigo">
    <button onclick="geraCodBarra()">Gerar Código (com AJAX)</button>
</div>

<img id="img-codigo-ajax" alt="Código de barras" style="margin-top: 15px;">


<div class="equipamentos-container">
    <div class="equipamentos-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gerenciamento de Equipamentos de EPI</h1>
        <button class="btn btn-primary new-user-btn" type="button" data-bs-toggle="modal" data-bs-target="#novoEquipamentoModal">
            <i class="bi bi-plus-lg me-2"></i> Novo Equipamento EPI 
        </button>
    </div>
    <p class="text-muted mb-4">Gerencie os equipamentos de EPI do sistema</p>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 card-stats-row">
        <div class="col">
            <div class="card card-stat total-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Total</h6>
                        <i class="bi bi-wrench fs-5"></i>
                    </div>
                    <div id="total-card-equip" class="stat-value"></div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card card-stat admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Em Estoque</h6>
                        <i class="bi bi-box-seam-fill fs-5"></i>
                    </div>
                    <div id="qtd-estoque" class="stat-value"></div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat operador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Em Uso</h6>
                        <i class="bi bi-gear-fill fs-5"></i>
                    </div>
                    <div id="qtd-em-uso" class="stat-value"></div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat visualizador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Sem Estoque</h6>
                        <i class="bi bi-clipboard-x-fill fs-5"></i>
                    </div>
                    <div id="qtd-sem-estoque" class="stat-value"></div>
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
                            <th scope="col" style="width: 10%;">Id</th>
                            <th scope="col" style="width: 20%;">Nome</th>
                            <th scope="col" style="width: 20%;">Descrição</th>
                            <th scope="col" style="width: 10%;">Imagem</th>
                            <th scope="col" style="width: 20%;">COD. Barra</th>
                            <th scope="col" style="width: 10%; text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-equipamento">
                        <!-- PUXARÁ POR AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Equipamentos de EPI</small>
            <small class="text-muted" id='qtd_epi'>1</small>
        </div>
    </div>

    <div class="modal fade" id="novoEquipamentoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content new-user-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="novoEquipamentoModalLabel">Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="text-muted">Configure as informações do equipamento</p>

                    <form id="form-equipamento" onsubmit="return false">
                        <div class="row mb-3">
                            <input type="hidden" id="txt-id-equip" value="NOVO" readonly>
                            <div class="col-md-6 mb-3">
                                <label for="txt-nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="txt-nome" placeholder="Óculos EPI" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="txt-descricao" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="txt-descricao" placeholder="Proteje o olho" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qtd" class="form-label">Estoque</label>
                                <input type="number" class="form-control" id="qtd" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="img" class="form-label">Imagem</label>
                                <input type="file" class="form-control" id="img" accept="image/*" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button onclick="salvarEquipamento()" class="btn btn-dark btn-create-user">Adicionar Equipamento</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ID, NOME, DESCRICAO, QTD, FOTO EQUIPAMENTO, IMG CODIGO DE BARRA -->