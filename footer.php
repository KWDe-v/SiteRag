   </div>
   <footer>
      <p>&copy; <?php echo date('Y'); ?> - Todos os direitos reservados, <?php echo $config['NameServer']; ?>.</p>
      <div class="contact">
         <span><a href="https://github.com/KWDe-v">KWDe-v</a></span>
         <a href="https://wa.me/55<?php echo $config['WhatsappNumber'];?>"><span><i class="fab fa-whatsapp"></i> <?php echo formatarTelefone($config['WhatsappNumber'])?></a></span>
         <a href="mailto:<?php echo $config['EmailAdmin'];?>"> <span><i class="fas fa-envelope"></i> <?php echo $config['EmailAdmin'];?></a></span>
      </div>
      <div class="socials">
         <a href="<?php echo $config['LinkFacebook'];?>"><i class="fab fa-facebook"></i></a>
         <a href="<?php echo $config['LinkDiscord'];?>"><i class="fab fa-discord"></i></a>
         <a href="<?php echo $config['LinkInstagram'];?>"><i class="fab fa-instagram"></i></a>
         <a href="<?php echo $config['LinkYoutube'];?>"><i class="fab fa-youtube"></i></a>
      </div>
   </footer>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/slick.min.js"></script>
   <script src="js/nouislider.min.js"></script>
   <script src="js/analytics.js"></script>
   <script src="js/wNumb.js"></script>
   <script src="js/database.js"></script>
   <script src="js/script.js"></script>
   <script src="js/itens.js"></script>
</body>
</html>