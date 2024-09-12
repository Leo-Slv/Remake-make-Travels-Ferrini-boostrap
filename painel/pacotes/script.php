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
    var destino = $(this).attr('destino');
    $('.modal #destino').val(destino);
    var periodo = $(this).attr('periodo');
    $('.modal #periodo').val(periodo);
    var acomodacao = $(this).attr('acomodacao');
    $('.modal #acomodacao').val(acomodacao);
    var parcela = $(this).attr('parcela');
    $('.modal #parcela').val(parcela);
  });

  $(document).on('click', '.delete', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var imagem = $(this).attr('imagem');
    $('.modal #imagem').val(imagem);

  });


</script>