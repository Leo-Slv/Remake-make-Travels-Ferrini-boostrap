<script>
  $(document).on('click', '.editst', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var status = $(this).attr('status');
    $('.modal #status').val(status);

  });


  $(document).on('click', '.editimg', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var imagem = $(this).attr('imagem');
    $('.modal #imagem').val(imagem);

  });

  $(document).on('click', '.edit', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var cidade = $(this).attr('cidade');
    $('.modal #cidade').val(cidade);
    var hotel = $(this).attr('hotel');
    $('.modal #hotel').val(hotel);
    var nota = $(this).attr('nota');
    $('.modal #nota').val(nota);
    var rua = $(this).attr('rua');
    $('.modal #rua').val(rua);
    var tipo = $(this).attr('tipo');
    $('.modal #tipo').val(tipo);
    var valor = $(this).attr('valor');
    $('.modal #valor').val(valor);
    var parcela = $(this).attr('parcela');
    $('.modal #parcela').val(parcela);
    var entrada = $(this).attr('entrada');
    $('.modal #entrada').val(entrada);
    var saida = $(this).attr('saida');
    $('.modal #saida').val(saida);
  });

  $(document).on('click', '.delete', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var imagem = $(this).attr('imagem');
    $('.modal #imagem').val(imagem);

  });


</script>