

<div>
    <h2>Cadastro de Colaborador</h2>
</div>

<div class="containerButton">
    <button type="button" class="btnNovoColaborador" data-toggle="modal" data-target="#meuModal" onclick='abrirModalNovo()'>
    + Novo Colaborador
</button>
</div>

<div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Cadastrar Colaborador</h5>
          <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body">
        <form id="form-colaborador" onsubmit="return false">
            <div>
                <label for="txt-id-colaborador">ID</label>
                <input class="form-control" type="text" id="txt-id-colaborador" value="NOVO" readonly required>
            </div>
            <br>
            <div>
                <label for="txt-nome-colaborador">Nome Completo</label>
                <input class="form-control" type="text" id="txt-nome-colaborador" required>
            </div>
            <br>
            <div>
                <label for="cpf-colaborador">CPF</label>
                <input class="form-control" type="text" id="cpf-colaborador" required>
            </div>
            <br>
            <div>
                <label for="txt-email-colaborador">Email</label>
                <input class="form-control" type="email" id="txt-email-colaborador" required>
            </div>
            <br>
            <div>
                <label for="txt-telefone-colaborador">Telefone</label>
                <input class="form-control" type="text" id="txt-telefone-colaborador" required>
            </div>
            <br>
            <div>
                <label for="data-nasc-colaborador">Data de nascimento</label>
                <input class="form-control" type="date" id="data-nasc-colaborador" required>
            </div>
            <br>
            <div>
                <label for="txt-cargo">Cargo</label>
                <input class="form-control" type="text" id="txt-cargo" required>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  onclick="fecharModal()" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="salvarColaboradores()">Salvar</button>
      </div>
    </div>
  </div>
</div>

<br>

<div class="row row-cols-1 row-cols-md-4 g-4 mb-5 card-stats-row">
        <div class="col">
            <div class="card card-stat total-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Total</h6>
                        <i class="bi bi-person-fill fs-5"></i>
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
                        <i class="bi bi-person-fill-gear fs-5"></i>
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
                        <i class="bi bi-person-fill-x fs-5"></i>
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
                        <i class="bi bi-person-fill-check fs-5"></i>
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
</div>

