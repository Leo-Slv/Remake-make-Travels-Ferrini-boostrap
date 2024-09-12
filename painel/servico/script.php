<script>
  $(document).on('click', '.edit', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var nome = $(this).attr('nome');
    $('.modal #nome').val(nome);
    var descricao = $(this).attr('descricao');
    $('.modal #descricao').val(descricao);
  });

  $(document).on('click', '.delete', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var imagem = $(this).attr('imagem');
    $('.modal #imagem').val(imagem);

  });

  $(document).on('click', '.editimg', function(){
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var imagem = $(this).attr('imagem');
    $('.modal #imagem').val(imagem);

  });

</script>