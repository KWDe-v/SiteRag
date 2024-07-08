<script>
   var originalButtonText;

$(document).ready(function() {
    $('#send-donate').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#input-submit-donate');
        $btn.prop('disabled', true);

        if (!originalButtonText) {
            originalButtonText = $btn.html();
        }
        $btn.html('<div class="circle" id="circle"></div>');
        $('#circle').show();

        $.ajax({
            type: 'POST',
            url: 'includes/doar.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#message-donate').html(response);
            },
            complete: function() {
                $btn.prop('disabled', false);
                $('#circle').hide();
                $btn.html(originalButtonText);
            }
        });
    });
});

</script>


<?php if (isset($_POST ['qrcode']) && !empty($_POST ['qrcode'])): ?>
<?php 

        
                $copiaCopia = $_POST ['copiaecola'];
                $imgQrCode = $_POST ['qrcode'];
                $transactionAmount = $_POST ['valor'];
                $externalReference = $_POST ['externalreference'];
                $pdo = CONNECT::getInstance();
                $query = $pdo->prepare("SELECT status FROM `payment` WHERE id = ?");
                $query->bind_param('i', $externalReference); // 
                $query->execute();
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $paymentStatus = $row['status'];
                    
                }
                if($paymentStatus == "processing"){
                    $paymentStatus = '<span class="processando">Em Processamento</span>';
                }

                
            


?>
                    <div class='container-qrcode'>
                       <h3>Valor: R$ <?php echo formatarValor($transactionAmount) ?></h3>  
                       <p>Status do pagamento: <span id='payment-status' class='<?php echo $paymentStatus ?>'><?php echo $paymentStatus ?></span></p>
                       <div class='qrcode-container'>
                          <img src='data:image/png;base64, <?php echo $imgQrCode ?>' class='centered-qrcode' />
                       </div>
                       <div class='centered-content'>
                          <a>
                             <p>Ou</p>
                          </a>
                          <a>
                             <p>Copie o codigo abaixo:</p>
                          </a>
                          <textarea><?php echo $copiaCopia ?></textarea>
                       </div>
                    </div>
               <script>
                   setInterval(function() {
                       var xhttp = new XMLHttpRequest();
                       xhttp.onreadystatechange = function() {
                           if (this.readyState == 4 && this.status == 200) {
                               var status = this.responseText.trim().toLowerCase();
                               var statusText;
                               var statusClass;

                               if (status === 'pending') {
                                   statusText = 'Aguardando Pagamento';
                                   statusClass = 'aguardando'; // classe para status pending
                               }
                               else if (status === 'approved') {
                                   statusText = 'Pagamento Aprovado';
                                   statusClass = 'aprovado'; // classe para status approved
                               }
                               else {
                                   statusText = 'Status Desconhecido';
                                   statusClass = 'desconhecido'; // caso haja outro status, ajuste conforme necessário
                               }

                               document.getElementById('payment-status').innerText = statusText;
                               document.getElementById('payment-status').className = statusClass;
                           }
                       };
                       xhttp.open('GET', 'includes/get_payment_status.php?external_reference=<?php echo $externalReference ?>', true);
                       xhttp.send();
                   }, 5000); // 5000 milissegundos = 5 segundos
               </script>


<?php elseif ($_SERVER['REQUEST_METHOD'] != 'POST') :?>
<!-- ==================  DOAÇÃO ================ -->
<div class="db-container">
   <h3>Doação</h3>
   <p>Ao doar, você está apoiando os custos de <em class="em">manutenção</em> e <em class="em">operação</em> deste servidor. Em troca, você será recompensado com <span class="em">CRÉDITOS DE DOAÇÃO</span> que poderão ser usados para comprar itens na nossa loja in-game.</p>
   <h3>Você está pronto(a) para doar?</h3>
   <p>Todas as doações para nós são recebidas via MercadoPago, mas não se preocupe! Mesmo que você não tenha uma conta no MercadoPago, ainda pode usar seu cartão de crédito para doar!</p>
   <form id="send-donate" class="form-container" style="width:45.7%;">
      <div class="generic-form-div" style="margin-bottom: 10px">
         <table class="generic-form-table">
            <tr>
               <th><label>Valor:</label></th>
               <td>
                  <p>R$ <?php echo formatarValor($config['Valor_Credito'])?> = <?php echo $config['Valor_Credito'] * $config['Bonus_Credito']?> crédito (s).</p>
               </td>
            </tr>
            <tr>
               <th><label>Doação Mínima:</label></th>
               <td>
                  <p>R$ <?php echo formatarValor($config['Min_Donation'])?></p>
               </td>
            </tr>
         </table>
      </div>
      <label>Valor da Doação</label>
      <input type="text" name="vl" id="vl">
      <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['conta']; ?>">
      <label>CPF</label>
      <input type="text" name="cpf" id="cpf">
      <label>Forma de Pagamento</label>
      <select name="pagamento" id="pagamento" class="select-donate">
         <option value="pix">Pix</option>
         <option value="cartao">Cartão (Em Breve)</option>
         <option value="link">Link</option>
      </select>
      <div id="message-donate"></div>
      <button id="input-submit-donate" type="submit" class="button">
         <div class="circle" id="circle"></div>
         Confirmar
      </button>
   </form>
</div>
<?php endif?>