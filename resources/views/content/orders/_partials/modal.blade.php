
<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Iniciar Pedido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-4">
              <label for="customer" class="form-label">Cliente</label>
              <input type="text" id="customer" class="form-control" placeholder="Cliente">
              <div id="autocomplete-results"></div>
            </div>
          </div>
  
          <div class="row g-4">
            <div class="col mb-0">
              <label for="tag" class="form-label">Comanda</label>
              <select class="select2 select-event-label form-select select2-hidden-accessible" id="tag" name="tag" data-select2-id="tag" tabindex="-1" aria-hidden="true">
                <option value="">#01</option>
                <option value="">#02</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="save-order">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  