@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Visualização de Pedido')

@section('content')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/css/orders/timeline.css') }}" />  
@endsection

<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Pedido /</span> Visualização
</h4>

<div class="row">
  <div class="col-12 col-lg-8">
     <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
           <h5 class="card-title m-0">Detalhes do Pedido</h5>
        </div>

        <div class="card-datatable table-responsive">
           <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
              <table class="datatables-order-details table dataTable no-footer dtr-column" id="DataTables_Table_0" style="width: 919px;">
                 <thead>
                    <tr>
                       <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" aria-label="">#</th>
                       <th class="w-50 sorting_disabled" rowspan="1" colspan="1" style="width: 354px;" aria-label="products">Produto/Serviço</th>
                       <th class="w-25 sorting_disabled" rowspan="1" colspan="1" style="width: 154px;" aria-label="price">Preço</th>
                       <th class="w-25 sorting_disabled" rowspan="1" colspan="1" style="width: 144px;" aria-label="qty">Quantidade</th>
                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 53px;" aria-label="total">Total</th>
                    </tr>
                 </thead>

                 <tbody>
                  @php $i = 0; @endphp
                  @foreach($order->items as $item)
                    <tr class="{{ ($i % 2 === 0) ? 'even' : 'odd' }}">
                       <td class="control" tabindex="0">{{ $item->id }}</td>
                       <td class="sorting_1">
                          <div class="d-flex justify-content-start align-items-center text-nowrap">
                             <div class="d-flex flex-column">
                                <h6 class="text-body mb-0">{{ $item->product_name }}</h6>
                             </div>
                          </div>
                       </td>
                       <td><span>R$ @money($item->product_price)</span></td>
                       <td><span>{{ $item->quantity }}</span></td>
                       <td>
                          <span>R$ @money($item->getTotal())</span>
                       </td>
                    </tr>
                    @php $i++; @endphp
                  @endforeach
                 </tbody>
              </table>
           </div>

           <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
              <div class="order-calculations">
                 <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Subtotal:</span>
                    <span class="text-heading">R$ @money($order->getSubtotal())</span>
                 </div>

                 <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Desconto:</span>
                    <span class="text-heading mb-0">R$ @money($order->total_discount)</span>
                 </div>

                 <div class="d-flex justify-content-between">
                    <h6 class="w-px-100 mb-0">Total:</h6>
                    <h6 class="mb-0">R$ @money($order->total_amount)</h6>
                 </div>
              </div>
           </div>
        </div>
     </div>

     <div class="card mb-4">
        <div class="card-header">
           <h5 class="card-title m-0">Registro de Atividades</h5>
        </div>
        
        <div class="card-body">
           <ul class="timeline pb-0 mb-0">
            @php $lastActivity = $order->activities->last(); @endphp
            @foreach ($order->activities as $activity)
              <li class="timeline-item timeline-item-transparent border-{{ $activity === $lastActivity ? 'transparent' : $activity->type->color() }}">
                 <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-{{ $activity->type->color() }}"></span></span>
                 <div class="timeline-event">
                    <div class="timeline-header">
                       <h6 class="mb-0">{{ $activity->type->label() }}</h6>
                       <span class="text-muted">{{ $activity->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <p class="mt-2">{{ $activity->description }}</p>
                 </div>
              </li>
            @endforeach
           </ul>
        </div>
     </div>
  </div>

  <div class="col-12 col-lg-4">
     <div class="card mb-4">
        <div class="card-header">
           <h6 class="card-title m-0">Informações do Cliente</h6>
        </div>

        <div class="card-body">
           <div class="d-flex justify-content-start align-items-center mb-4">
              <div class="avatar me-2">
                <span class="avatar-initial rounded-circle bg-label-primary">{{ $order->customer->getInitials() }}</span>
              </div>
              <div class="d-flex flex-column">
                 <a href="{{ route('customers.edit', $order->customer) }}" class="text-body text-nowrap">
                    <h6 class="mb-0">{{ $order->customer->name }}</h6>
                 </a>
                 <small class="text-muted">ID: #{{ $order->customer->id }}</small>
              </div>
           </div>

           <div class="d-flex justify-content-start align-items-center mb-4">
              <span class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i class="bx bx-cart-alt bx-sm lh-sm"></i></span>
              <h6 class="text-body text-nowrap mb-0">{{ $order->customer->getTotalOrders() }} Pedido(s)</h6>
           </div>

           <div class="d-flex justify-content-between">
              <h6>Informações de Contato</h6>
           </div>
           <p class=" mb-0">Telefone: {{ $order->customer->phone ?? 'Sem Cadastro' }}</p>
        </div>
     </div>

     <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
           <h6 class="card-title m-0">Informações do Pagamento</h6>
        </div>
        <div class="card-body">
           <p class="mb-0">{{ $order->paymentMethod->name }}</p>
        </div>
     </div>
  </div>
</div>

@endsection
