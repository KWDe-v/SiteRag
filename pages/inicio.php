<!-- ==================  TELA DE INICIO ================ -->
<div class="boxForm">

   <h1>Inicio</h1>
   <h3 align="center">Seja bem Vindo, <?php echo$user;?></h3>
   <a href="#" class="redirectTo" onclick="mostrarFormularioTrocarSenha()">Trocar Senha</a>
   <a href="#" class="redirectTo" onclick="mostrarFormularioTrocarEmail()">Trocar Email</a>
</div>
<!-- ==================  TROCA DE SENHA ================ -->
<div id="overlay-TrocarSenha">
   <div class="containerFormsJS">
      <h1>Troca de Senha</h1>
      <form id="formTrocarSenha">
         <a href="#" style="float: right;" onclick="fecharFormularioTrocarSenha()" class="closeForm"><img src="img/icones/close.png" ></a>
         <center>
            <input type="password" name="senhaatual" id="senhaatual" placeholder="Senha Atual">
            <input type="hidden" name="IDformTrocarSenha" id="IDformTrocarSenha" value="<?php echo rand();?>" >
            <input type="password" name="senhanova" id="senhanova" placeholder="Nova Senha">
            <input type="password" name="confsenhanova" id="confsenhanova" placeholder="Confirmar Nova Senha">
         </center>
         <div id="message-TrocarSenha"></div>
         <button id="submitTrocarSenha" type="submit" class="button">Trocar Senha</button>
      </form>
   </div>
</div>
<!-- ==================  TROCA DE EMAIL ================ -->
<div id="overlay-TrocarEmail">
   <div class="containerFormsJS">
      <h1>Troca de Senha</h1>
      <form id="formTrocarEmail">
         <a href="#" style="float: right;" onclick="fecharFormularioTrocarEmail()" class="closeForm"><img src="img/icones/close.png" ></a>
         <center>
            <input type="text" name="emailatual" id="emailatual" placeholder="Email Atual">
            <input type="hidden" name="IDformTrocarEmail" id="IDformTrocarEmail" value="<?php echo rand();?>" >
            <input type="text" name="emailnovo" id="emailnovo" placeholder="Novo Email">
            <input type="text" name="confemailnovo" id="confemailnovo" placeholder="Confirmar Novo Email">
         </center>
         <div id="message-TrocarEmail"></div>
         <button id="submitTrocarEmail" type="submit" class="button">Trocar Email</button>
      </form>
   </div>
</div>
