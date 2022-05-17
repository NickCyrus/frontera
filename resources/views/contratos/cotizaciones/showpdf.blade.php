<div class="container">
        @php 
            $idtoken = base64_encode(base64_encode("{$cotizacionid}|".date("yimsd")));
        @endphp
        <div class="row">
                <div class="col-md-12">
                    <h3>Cotización</h3>    
                    <a target="_blank" href="{{route('cotizacion.pdf.view',['id'=>$idtoken])}}" class="btn btn-info "><i class='bx bxs-file-pdf'></i> Ver cotización </a>
                    <a target="_blank" href="{{route('cotizacion.pdf.download',['id'=>$idtoken])}}" class="btn btn-warning"><i class='bx bx-down-arrow-circle' ></i> Descargar cotización </a>
                </div>

                <div class="col-md-12 mt-5">
                    
                    <form method="POST" action="{{route('contratos.cotizaciones.sendmail',['item'=>$cotizacionid])}}" onsubmit="fn.wait('Por favor espere se está enviando el correo')" >
                        @csrf
                          <h5>Enviar por correo</h5>
                          <div class="form-group mb-3">
                              <label>Para</label>
                              <input class="form-control" name="to" id="to" required />
                          </div>
                          <div class="form-group mb-3">
                            <label>Asunto</label>
                            <input class="form-control" name="subject" id="subject" required />
                          </div>
                          <div class="form-group mb-3">
                            <label>Mensaje</label>
                            <textarea class="form-control" name="msg" id="msg" rows="5"></textarea>
                          </div>
                          <div class="form-group mt-3">
                                <button class="btn btn-frontera"><i class='bx bx-mail-send' ></i> Enviar</button>
                          </div>
                    </form>
                </div>
        </div>
</div>