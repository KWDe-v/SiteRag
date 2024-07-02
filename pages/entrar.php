<!--  ================== FORMULARIO DE LOGIN ================  -->
<div class="boxForm">
   <h1>Login</h1>
   <form id="formLogin" name="formLogin" method="POST">
      <center>
         <input type="hidden" name="IDformLogin" id="IDformLogin" value="<?php echo rand();?>" >
         <input type="text" name="usuario" id="usuario" placeholder="Nome de Usuário">
         <a href="#" style="float: right;" onclick="mostrarFormularioResetSenha()"> Esqueceu a senha?</a>
         <input type="password" name="senha" id="senha" placeholder="Senha">
      </center>
      <div id="message"></div>
      <button id="submitLogin" type="submit" class="button">Entrar</button>
      <p>Não tem uma conta? <a href="?to=registro">Registre-se</a></p>
   </form>
</div>
<!--  ================== FORMULARIO DE RECUPERAÇÃO DE SENHA ================  -->
<div id="overlay-recuperarSenha">
   <div class="containerFormsJS">
      <h1>Recuperação de Senha</h1>
      <form id="formRecuperarSenha">
         <a href="#" style="float: right;" onclick="fecharFormularioResetSenha()" class="closeForm"><img src="img/close.png" ></a>
         <center>
            <input type="text" name="usernameResetSenha" id="usernameResetSenha" placeholder="Nome de Usuário">
            <input type="hidden" name="IDformRecuperarSenha" id="IDformRecuperarSenha" value="<?php echo rand();?>" >
            <input type="email" name="emailResetSenha" id="emailResetSenha" placeholder="Email">
         </center>
         <div id="message-RecuperarSenha"></div>
         <button id="submitRecuperarSenha" type="submit" class="button">Enviar Link de Recuperação</button>
      </form>
   </div>
</div>