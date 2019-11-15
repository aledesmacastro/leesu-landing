<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Leesu</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css"/>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
  </head>
  <body>
    <header class="header">
      <div class="container_fluid">
        <div class="header_container">
          <div class="header__logo"> <img src="/" alt="" srcset="/"/>
            <div class="header__title"> 
              <h1>Leesu</h1>
            </div>
            <div class="header__subtitle">Su mejor opción <img class="people-carry" src="<?php echo base_url(); ?>images/logos/men-carrying-a-box.png" alt=""/></div>
          </div>
          <div class="header__navegacion"></div>
          <div class="header__contact">
            <div class="header__contact__number"> <a href="tel:+123 6534 55">PBX: 123 6534 55</a></div>
            <div class="header__contact__email"><a href="mailto:info@leesu.co">info@leesu.co</a></div>
          </div>
        </div>
      </div>
    </header>
    <main class="mainContent">
      <div class="container_fluid">
        <div class="container_main">
          <div class="asideLeft">
            <h2>Lorem ipsum dolor sit, amet consectetur adipisicing.</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, quas.</p>
          </div>
          <div class="asideRight__formulario">
            <form action="" method="post" id="leads_form">
              <div class="group_title">
                <h2>Información de contacto</h2>
              </div>
              <div class="group_info_names">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" />
                <span id="first_name_error"></span>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" />
                <span id="last_name_error"></span>
              </div>
              <div class="group_contact">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" />
                <span id="email_error"></span>
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" />
                <span id="phone_error"></span>
              </div>
              <div class="group_residen_information">
                <label for="city">Ciudad</label>
                <input type="text" name="city" id="city" />
                <span id="city_error"></span>
              </div>
              <div class="group_politics">
                <label for="comments">Comentarios</label>
                <textarea name="comments" cols="30" rows="10" id="comments"></textarea>
                <label for="accept">Lorem ipsum dolor sit amet.</label>
                <input type="checkbox" name="accept" id="accept" />
                <input class="campaign" type="hidden" name=""/>
              </div>
              <div class="group_buttons">
                <button type="button" value="Enviar" id="send">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <section class="postContent">
      <div class="container_fluid">
        <ul>
          <li>Lorem, ipsum.</li>
          <li>Lorem, ipsum dolor.</li>
          <li>Lorem ipsum dolor sit.</li>
        </ul>
      </div>
    </section>
    <Section class="preFooter">
      <div class="container_fluid">
        <section class="preFooter">
          <div class="contentSocial">
            <p>REDES SOCIALES</p>
            <ul>
              <li><a href="facebook">facebook</a></li>
              <li><a href="twitter">twitter</a></li>
              <li><a href="instagram">instagram</a></li>
              <li><a href="whatsapp">whatsapp</a></li>
            </ul>
          </div>
        </section>
      </div>
    </Section>
    <footer class="footer">
      <div class="container_fluid">
        <div class="footer_container">
          <div class="footer_logo">Lorem, ipsum dolor.<img src="" alt="logo" srcset=""/></div>
          <div class="footer_information">
            <p>
              Lorem ipsum dolor sit amet consectetur,
              adipisicing elit. Culpa, sapiente.
            </p>
            <p><b>© 2019 Leesu todos los derechos reservados</b><span>Política de privacidad.</span></p>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>

<script>
    $(document).ready(function(){

      $('#send').on('click',function(){
          var first_name = $('#first_name').val();
          var last_name = $('#last_name').val();
          var email = $('#email').val();
          var phone = $('#phone').val();
          var city = $('#city').val();
          var comments = $('#comments').val();

          if($("#accept").is(':checked')) {  
              $.ajax({
                url:"<?php echo site_url('Leads/action'); ?>",
                method:"POST",
                data:{data_action: 'create', first_name: first_name, last_name: last_name, email: email, phone: phone, city: city, comments: comments},
                dataType:"json",
                success:function(data){
                    if (data.success) {
                      swal("Finaliza Registro", "Procesado Realizado Exitosamente", "success");
                      $('#leads_form')[0].reset();
                    }

                    if (data.error) {
                      $('#first_name_error').html(data.first_name_error);
                      $('#last_name_error').html(data.last_name_error);
                      $('#email_error').html(data.email_error);
                      $('#phone_error').html(data.phone_error);
                      $('#city_error').html(data.city_error);
                    }
                }
              });
          } else {  
              swal("Autorización", "Para realizar el registro primero debe autorizar el tratamiento de sus datos", "info");
          } 

      });

  });  
</script>