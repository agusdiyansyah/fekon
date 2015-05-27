<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $this->load->view('partials_admin/metadata');?>
  </head>
  <body class="skin-black">
    <!-- menu atas -->
    <?php echo $this->load->view('partials_admin/header');?>

    <div class="wrapper row-offcanvas row-offcanvas-left"> 
      <!-- menu samping -->
      <?php echo $this->load->view('partials_admin/menu');?>
      <aside class="right-side">
        <!-- kontent -->
        <?php echo $template['body'];?>
      </aside>
    </div>
  
  </body>
</html>