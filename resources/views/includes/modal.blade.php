<div class="modal fade" id="{{$modalId}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="{{$modalId}}Label" aria-hidden="true">
    <div class="modal-dialog @if(!empty($modalSize)) {{$modalSize}} @endif">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" @isset($modalTitleId) id="{{$modalTitleId}}" @endisset>{{$modalTitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" @isset($modalBodyId) id="{{$modalBodyId}}" @endisset>
        @isset($modalBody)
            {{$modalBody}}
        @endisset
      </div>
      <div class="modal-footer" @isset($modalFooterId) id="{{$modalFooterId}}" @endisset>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{$modalBotonCerrar}}</button>
        @isset($modalBotonAceptarId)
        <button type="button" class="btn btn-primary" id="{{$modalBotonAceptarId}}">{{$modalBotonAceptar}}</button>
        @endisset
      </div>
    </div>
  </div>
</div>