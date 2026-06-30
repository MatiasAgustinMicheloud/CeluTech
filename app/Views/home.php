<section id="billboard" class="position-relative overflow-hidden bg-light-blue" style="padding-top: 120px">
  <div class="swiper main-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-md-6">
              <div class="banner-content">
                <h1 class="display-2 text-uppercase text-dark pb-5">Los mejores celulares al mejor precio.</h1>
                <a href="<?= base_url('catalogo') ?>" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Ver Productos</a>
              </div>
            </div>
            <div class="col-md-5">
              <div class="image-holder">
                <img src="<?= base_url('public/images/banner-image.png') ?>" alt="banner" >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="container">
          <div class="row d-flex flex-wrap align-items-center">
            <div class="col-md-6">
              <div class="banner-content">
                <h1 class="display-2 text-uppercase text-dark pb-5">La tecnología que estabas buscando</h1>
                <a href="<?= base_url('catalogo') ?>" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Ver Productos</a>
              </div>
            </div>
            <div class="col-md-5">
              <div class="image-holder">
                <img src="<?= base_url('public/images/banner-image.png') ?>" alt="banner" >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="swiper-icon swiper-arrow swiper-arrow-prev">
    <svg class="chevron-left"><use xlink:href="#chevron-left" /></svg>
  </div>
  <div class="swiper-icon swiper-arrow swiper-arrow-next">
    <svg class="chevron-right"><use xlink:href="#chevron-right" /></svg>
  </div>
</section>


    <section id="company-services" class="padding-large">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="cart-outline"><use xlink:href="#cart-outline" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Envío gratis</h3>
            <p>En compras superiores a $500.000.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="quality"><use xlink:href="#quality" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Calidad garantizada</h3>
            <p>Productos originales con garantía oficial.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="price-tag"><use xlink:href="#price-tag" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Ofertas diarias</h3>
            <p>Descuentos exclusivos todos los días.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="shield-plus"><use xlink:href="#shield-plus" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Pago 100% seguro</h3>
            <p>Tus datos y compras siempre protegidos.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



  <style>
  .product-card .image-holder {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .product-card:hover .image-holder {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
  </style>
   <section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
  <div class="container">
    <div class="row">
      <div class="display-header d-flex justify-content-between pb-3">
        <h2 class="display-7 text-dark text-uppercase">Productos Destacados</h2>
        <div class="btn-right">
          <a href="<?= base_url('catalogo') ?>" class="btn btn-medium btn-normal text-uppercase">Ver Catálogo</a>
        </div>
      </div>
      <div class="swiper product-swiper">
        <div class="swiper-wrapper">
          <?php foreach($productos_destacados as $producto): ?>
          <div class="swiper-slide" style="margin: 50px">
            <div class="product-card position-relative">
              <div class="image-holder" style="height: 380px; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <?php if($producto['producto_imagen']): ?>
                    <img src="<?= base_url('images/productos/' . $producto['producto_imagen']) ?>" 
                        alt="<?= $producto['producto_nombre'] ?>" 
                        class="img-fluid" 
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                <?php else: ?>
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 280px; border-radius: 12px;">
                        <span class="text-muted">Sin imagen</span>
                    </div>
                <?php endif; ?>
              </div>
              <div class="cart-concern position-absolute">
                <div class="cart-button d-flex">
                  <a href="<?= base_url('catalogo/' . $producto['id_producto']) ?>" class="btn btn-medium btn-black">Ver detalle</a>
                </div>
              </div>
              <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                <h3 class="card-title text-uppercase">
                  <a href="<?= base_url('catalogo/' . $producto['id_producto']) ?>"><?= $producto['producto_nombre'] ?></a>
                </h3>
                <?php if($producto['producto_precio_oferta']): ?>
                  <span class="item-price text-primary">$<?= number_format($producto['producto_precio_oferta'], 0) ?></span>
                <?php else: ?>
                  <span class="item-price text-primary">$<?= number_format($producto['producto_precio'], 0) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="swiper-pagination position-absolute text-center"></div>
</section>

<section id="about" class="padding-large bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="display-7 text-uppercase text-dark mb-4">Sobre Nosotros</h2>
        <p class="text-muted">
          En <strong>CeluTech</strong> nos dedicamos a ofrecerte los mejores celulares 
          al mejor precio. Trabajamos con las marcas más reconocidas del mercado 
          para garantizarte calidad, originalidad y garantía oficial en cada compra.
        </p>
        <p class="text-muted">
          Nuestro objetivo es brindarte una experiencia de compra simple, rápida 
          y segura, con atención personalizada y los mejores precios de la región.
        </p>
      </div>
      <div class="col-md-6 text-center">
        <img src="<?= base_url('public/images/banner-image.png') ?>" alt="Sobre nosotros" style="max-width: 50%;">
      </div>
    </div>
  </div>
</section>

    
    <section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 padding-xlarge" style="background-image: url('<?= base_url('public/images/single-image1.png') ?>'); background-position: right; background-repeat: no-repeat;">
  <div class="row d-flex flex-wrap align-items-center">
    <div class="col-md-6 col-sm-12">
      <div class="text-content offset-4 padding-medium">
        <h3>Hasta 15% off</h3>
        <h2 class="display-2 pb-5 text-uppercase text-dark">Ofertas de la semana</h2>
        <a href="<?= base_url('catalogo?oferta=1') ?>" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Ver Ofertas</a>
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
    </div>
  </div>
</section>
