<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
    if(isset($template['partials']['metadata'])){
      echo $template['partials']['metadata'];
    }
    else {
      $this->load->view('partials/metadata');
    }
    ?>
  </head>
  <body>
    <div class="container">
      <!--Header-->
        <br>
        <?php 
        if (isset($template['partials']['header'])){
          echo $template['partials']['header'];
        }
        else {
          $this->load->view('partials/header');
        }
        ?>
      <!--Header End-->
      <!-- Menu -->
        <?php echo Modules::run("menu");?>
      <!-- Menu End -->

      <!-- Content -->
        <?php echo $template['body']; ?>
      <!-- Content End -->

      <br>

      <!-- Footer -->
        <div class="row">
          <?php 
            if (isset($template['partials']['footer'])) {
              echo $template['partials']['footer']; 
            }
            else {
              $this->load->view('partials/footer');
            }
          ?>
        </div>
      <!-- Footer End -->
    </div>
  </body>
</html>