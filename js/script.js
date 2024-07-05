// ==================  TERMOS ================ //

    function mostrarTermos() {
      document.getElementById("overlay-Termos").style.display = "block";
      var overlay = document.getElementById("overlay-Termos");
      overlay.style.display = "block"; 
      setTimeout(function() {
        overlay.classList.add("active"); 
      }, 100);

    }

    
    function fecharTermos() {

      var overlay = document.getElementById("overlay-Termos");
      overlay.style.display = "none";
      overlay.classList.remove("active");

    }

// ==================  FORMULÁRIO TROCA DE EMAIL ================ //

    function mostrarFormularioTrocarEmail() {
      document.getElementById("overlay-TrocarEmail").style.display = "block";
      var overlay = document.getElementById("overlay-TrocarEmail");
      overlay.style.display = "block"; 
      setTimeout(function() {
        overlay.classList.add("active"); 
      }, 100);

    }

    
    function fecharFormularioTrocarEmail() {

      var overlay = document.getElementById("overlay-TrocarEmail");
      overlay.style.display = "none";
      overlay.classList.remove("active");

    }

// ==================  FORMULÁRIO TROCA DE SENHA================ //

    function mostrarFormularioTrocarSenha() {
      document.getElementById("overlay-TrocarSenha").style.display = "block";
      var overlay = document.getElementById("overlay-TrocarSenha");
      overlay.style.display = "block"; 
      setTimeout(function() {
        overlay.classList.add("active"); 
      }, 100);
    }

    
    function fecharFormularioTrocarSenha() {
      var overlay = document.getElementById("overlay-TrocarSenha");
      overlay.style.display = "none";
      overlay.classList.remove("active");
      var messageElement = document.getElementById("message-TrocarSenha");
      messageElement.textContent = "";  
    }

// ==================  FORMULÁRIO RECUPERAÇÃO DE SENHA================ //

    function mostrarFormularioResetSenha() {
      document.getElementById("overlay-recuperarSenha").style.display = "block";
      var overlay = document.getElementById("overlay-recuperarSenha");
      overlay.style.display = "block"; 
      setTimeout(function() {
        overlay.classList.add("active"); 
      }, 100);
      var messageElement = document.getElementById("message");
      messageElement.textContent = "";  
    }

    
    function fecharFormularioResetSenha() {
    // Esconder o overlay
      var overlay = document.getElementById("overlay-recuperarSenha");
      overlay.style.display = "none";
      overlay.classList.remove("active");
      var messageElement = document.getElementById("message-RecuperarSenha");
      messageElement.textContent = "";  
    }

// ==================  AJAX FORMULARIO DE LOGIN ================ //

var originalButtonText;
    $(document).ready(function() {
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#submitLogin');
            $btn.prop('disabled', true);
            if (!originalButtonText) {
                originalButtonText = $btn.html();
            }
            $btn.html('<div class="circle" id="circle"></div>');
            $('#circle').show();


            $.ajax({
                type: 'POST',
                url: 'includes/entrar.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#message').html(response);
                    
                },
                error: function(xhr, status, error) {
                    
                    console.error('Erro na requisição', status, error);
                },
                complete: function() {
                    $('#circle').hide();
                    $btn.html(originalButtonText);
                    $btn.prop('disabled', false);
                }
            });
        });
    });    

// ==================  AJAX FORMULARIO DE RECUPERAÇÃO DE SENHA ================ //

    $(document).ready(function() {
        $('#formRecuperarSenha').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#submitRecuperarSenha');
            $btn.prop('disabled', true);
             if (!originalButtonText) {
                originalButtonText = $btn.html();
            }
            $btn.html('<div class="circle" id="circle"></div>');
            $('#circle').show();
            $.ajax({
                type: 'POST',
                url: 'includes/recuperarsenha.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#message-RecuperarSenha').html(response);
                    
                },
                error: function(xhr, status, error) {
                    
                    console.error('Erro na requisição', status, error);
                },
                complete: function() {
                    $('#circle').hide();
                    $btn.html(originalButtonText);
                    $btn.prop('disabled', false);
                }
            });
        });
    });    

// ==================  AJAX FORMULARIO DE TROCA DE SENHA ================ //

    $(document).ready(function() {
        $('#formTrocarSenha').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#submitTrocarSenha');
            $btn.prop('disabled', true);
             if (!originalButtonText) {
                originalButtonText = $btn.html();
            }
            $btn.html('<div class="circle" id="circle"></div>');
            $('#circle').show();
            $.ajax({
                type: 'POST',
                url: 'includes/trocarsenha.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#message-TrocarSenha').html(response);
                    
                },
                error: function(xhr, status, error) {
                    
                    console.error('Erro na requisição', status, error);
                },
                complete: function() {
                    $('#circle').hide();
                    $btn.html(originalButtonText);
                    $btn.prop('disabled', false);
                }
            });
        });
    });

// ==================  AJAX FORMULARIO DE TROCA DE EMAIL ================ //

    $(document).ready(function() {
        $('#formTrocarEmail').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#submitTrocarEmail');
            $btn.prop('disabled', true);
             if (!originalButtonText) {
                originalButtonText = $btn.html();
            }
            $btn.html('<div class="circle" id="circle"></div>');
            $('#circle').show();
            $.ajax({
                type: 'POST',
                url: 'includes/trocaremail.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#message-TrocarEmail').html(response);
                    
                },
                error: function(xhr, status, error) {
                    
                    console.error('Erro na requisição', status, error);
                },
                complete: function() {
                    $('#circle').hide();
                    $btn.html(originalButtonText);
                    $btn.prop('disabled', false);
                }
            });
        });
    });     

// ==================  AJAX FORMULARIO DE REGISTRO ================ //

    $(document).ready(function() {
        $('#formRegistro').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#submitRegistro');
            $btn.prop('disabled', true);
             if (!originalButtonText) {
                originalButtonText = $btn.html();
            }
            $btn.html('<div class="circle" id="circle"></div>');
            $('#circle').show();
            $.ajax({
                type: 'POST',
                url: 'includes/registro.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#message').html(response);
                    
                },
                error: function(xhr, status, error) {
                    
                    console.error('Erro na requisição', status, error);
                },
                complete: function() {
                    $('#circle').hide();
                    $btn.html(originalButtonText);
                    $btn.prop('disabled', false);
                }
            });
        });
    });


    function goToPage(event) {
    event.preventDefault();
    const pageNumber = document.getElementById('page-number').value;
    if (pageNumber) {
        const currentUrl = new URL(window.location.href);
        const searchParams = new URLSearchParams(currentUrl.search);
        searchParams.set('page', pageNumber);
        currentUrl.search = searchParams.toString();
        window.location.href = currentUrl.toString();
    }
}

function submitFormFilter(radio) {
    const form = document.getElementById('filterForm');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData).toString();
    fetch(`${window.location.pathname}?${params}`)
        .then(response => response.text())
        .then(data => {
            document.body.innerHTML = data; // 
        })
        .catch(error => console.error('Error:', error));
}


        function toggleSearchForm() {

            $('.filterdb').slideToggle('slow');  
            $('.filterdb').css('display', 'flex');
        }