<div class="card mb-0">
    <div class="card-header bg-dark">
        <h3 class="card-title">RESUMEN DE CAMBIOS <strong>#{{ $id }}</strong></h3>
    </div>
    @if($row)
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {{ $row->module }}
                {{ $row->created_at }}
                {{ $row->action }}
                {{ $row->record_id1 }}
                {{ $row->record_id2 }}
            </div>
        </div>
    </div>
    @endif
    <div class="card-body table-responsive p-0">
        @if($row)
            <table class="table table-sm table-hover" style="font-size:0.9rem;">
                <thead>
                    <tr>
                        <th width="180" class="border-right">CAMPO</th>
                        <th class="border-right">VALOR ANTERIOR</th>
                        <th>NUEVO VALOR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($r1 as $k => $v )                            
                        @if($c['r1'][$k] != $c['r2'][$k])
                            <tr>
                                <td class="border-right">{{ $k }}</td>
                                <td class="border-right text-monospace">{{ $c['r1'][$k] }}</td>
                                <td class="text-monospace">{{ $c['r2'][$k] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
                 
           
        @else
            <p class="lead">El registro no existe</p>
        @endif
    </div>
    
    <div class="card-footer">
        @if($row)
            <!--
                <a href="{{ route('changelog.edit',$row->id) }}" class="btn btn-secondary"><i class="fas fa-print fa-fw"></i> Extender</a>
            -->
            <button type="button" class="btn btn-primary float-right" data-dismiss="modal"><i class="fas fa-times fa-fw"></i> Cerrar</button>
        @else
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times fa-fw"></i> Cancelar</button>
        @endif
    </div>
</div>