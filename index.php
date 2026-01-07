<?php
/**
 * Homepage - Netmatters
 */
require_once __DIR__ . '/config/init.php';

$pageTitle = 'Netmatters Homepage';

// Fetch news posts from database
try {
    $db = Database::getInstance();
    $news = new News($db->getConnection());
    $newsPosts = $news->getLatestPosts(3);
} catch (PDOException $e) {
    $newsPosts = [];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include __DIR__ . '/includes/head.php'; ?>
  </head>
  <body>
    <div id="container">
      <?php include __DIR__ . '/includes/header.php'; ?>

      <main>
        <section class="banner">
          <!-- Container for the hero slider/carousel -->
          <div class="banner__hero-container">
            <!-- Wrapper for the individual hero items/slides -->
            <div class="banner__hero-items-wrapper">
              <!-- Banner 1 -->
              <div class="banner__hero-item banner__hero-item--1">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">
                      The East Of England's Leading Technology Company
                    </h1>
                    <p class="banner__tagline">
                      Performance-driven digital and technology services with
                      complete transparency.
                    </p>
                    <a href="#" class="banner__button"
                      >Why Choose Us?
                      <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
              <!-- Banner 2 -->
              <div class="banner__hero-item banner__hero-item--2">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">Bespoke Software</h1>
                    <p class="banner__tagline">
                      Delivering expert bespoke software solutions across a
                      range of industries.
                    </p>
                    <a href="#" class="banner__button"
                      >Our Software <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
              <!-- Banner 3 -->
              <div class="banner__hero-item banner__hero-item--3">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">IT Support</h1>
                    <p class="banner__tagline">
                      Fast and cost-effective IT support services for your
                      business.
                    </p>
                    <a href="#" class="banner__button"
                      >Get Support <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
              <!-- Banner 4 -->
              <div class="banner__hero-item banner__hero-item--4">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">Digital Marketing</h1>
                    <p class="banner__tagline">
                      Generating your new business through results-driven
                      marketing activities.
                    </p>
                    <a href="#" class="banner__button"
                      >Our Services <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
              <!-- Banner 5 -->
              <div class="banner__hero-item banner__hero-item--5">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">Telecoms Services</h1>
                    <p class="banner__tagline">
                      A new approach to connectivity, see how we can help your
                      business.
                    </p>
                    <a href="#" class="banner__button"
                      >View Telecoms
                      <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
              <!-- Banner 6 -->
              <div class="banner__hero-item banner__hero-item--6">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">Web Design</h1>
                    <p class="banner__tagline">
                      For businesses looking to make a strong and effective
                      first impression.
                    </p>
                    <a href="#" class="banner__button"
                      >Our Portfolio
                      <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
              <!-- Banner 7 -->
              <div class="banner__hero-item banner__hero-item--7">
                <div class="container">
                  <div class="banner__menu-container">
                    <h1 class="banner__heading">Cyber Security</h1>
                    <p class="banner__tagline">
                      Keeping businesses and their customers sensitive
                      information protected.
                    </p>
                    <a href="#" class="banner__button"
                      >Stay Secure <span class="icon icon-arrow-right21"></span
                    ></a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Navigation dots for the hero banner carousel -->
            <div class="banner__hero-nav">
              <button
                data-banner-id="0"
                class="banner__hero-nav-button--active"
              ></button>
              <button data-banner-id="1"></button>
              <button data-banner-id="2"></button>
              <button data-banner-id="3"></button>
              <button data-banner-id="4"></button>
              <button data-banner-id="5"></button>
              <button data-banner-id="6"></button>
            </div>
          </div>
        </section>

        <section class="services">
          <div class="container">
            <!-- A container to position the heading and "View Our Work" link -->
            <div class="space-between-heading-and-view-more-link">
              <!-- The heading for the services section -->
              <h2 class="services__heading">Our Services</h2>
              <!-- A link to view case studies, visible on wide viewports -->
              <a
                href="#"
                class="services__view-case-studies-link services__view-case-studies-link--wide-viewport"
                >View Our Work
                <span class="icon icon-arrow-right21"></span>
              </a>
            </div>

            <!-- A container for the grid of service cards -->
            <div class="services__menu-container">
              <!-- A service card for Bespoke Software -->
              <a
                href="#"
                class="services__card services__card--bespoke-software"
              >
                <span class="services__card-icon-background">
                  <span class="icon icon-laptop">
                    <span class="icon icon-fa--gears"></span>
                  </span>
                </span>
                <h3 class="services__card-heading">Bespoke Software</h3>
                <p class="services__card-description">
                  Bespoke software solutions for all your business needs
                  including integrations and reporting.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--bespoke-software"
                  >Read more</span
                >
              </a>

              <!-- A service card for IT Support -->
              <a href="#" class="services__card services__card--it-support">
                <span class="services__card-icon-background">
                  <span class="icon icon-display"></span>
                </span>
                <h3 class="services__card-heading">IT Support</h3>
                <p class="services__card-description">
                  Fully managed IT support and consultancy packages tailored to
                  meet your exact business needs.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--it-support"
                  >Read more</span
                >
              </a>

              <!-- A service card for Digital Marketing -->
              <a
                href="#"
                class="services__card services__card--digital-marketing"
              >
                <span class="services__card-icon-background">
                  <span class="icon icon-bar-chart-fill"></span>
                </span>
                <h3 class="services__card-heading">Digital Marketing</h3>
                <p class="services__card-description">
                  Driven brand awareness & ROI through creative digital
                  marketing campaigns.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--digital-marketing"
                  >Read more</span
                >
              </a>

              <!-- A service card for Telecoms Services -->
              <a
                href="#"
                class="services__card services__card--telecoms-services"
              >
                <span class="services__card-icon-background">
                  <span
                    class="icon icon-material-symbols--phone-in-talk"
                  ></span>
                </span>
                <h3 class="services__card-heading">Telecoms Services</h3>
                <p class="services__card-description">
                  Business telephony solutions including mobile & connectivity
                  solutions.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--telecoms-services"
                  >Read more</span
                >
              </a>

              <!-- A service card for Web Design -->
              <a href="#" class="services__card services__card--web-design">
                <span class="services__card-icon-background">
                  <span class="icon icon-code"></span>
                </span>
                <h3 class="services__card-heading">Web Design</h3>
                <p class="services__card-description">
                  User-centric design for businesses looking to make a lasting
                  impression.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--web-design"
                  >Read more</span
                >
              </a>

              <!-- A service card for Cyber Security -->
              <a href="#" class="services__card services__card--cyber-security">
                <span class="services__card-icon-background">
                  <span class="icon icon-material-symbols--security"></span>
                </span>
                <h3 class="services__card-heading">Cyber Security</h3>
                <p class="services__card-description">
                  Prevention, testing, consultancy & breach management services.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--cyber-security"
                  >Read more</span
                >
              </a>

              <!-- A service card for Developer Training -->
              <a
                href="#"
                class="services__card services__card--developer-training"
              >
                <span class="services__card-icon-background">
                  <span class="icon icon-material-symbols--school"></span>
                </span>
                <h3 class="services__card-heading">Developer Training</h3>
                <p class="services__card-description">
                  Web design & software training courses designed to secure a
                  job in tech.
                </p>
                <span
                  class="services__card-read-more-button services__card-read-more-button--developer-training"
                  >Read more</span
                >
              </a>
            </div>
            <!-- A container for the "View Our Work" link on mobile viewports -->
            <div>
              <a
                href="#"
                class="services__view-case-studies-link services__view-case-studies-link--mobile-viewport"
                >View Our Work
                <span class="icon icon-arrow-right21"></span>
              </a>
            </div>
          </div>
        </section>

        <section class="partners">
          <div class="associates-logo-container">
            <div class="associates-logo-layout-container">
              <!-- Individual partner logos -->
              <img
                src="img/partners/cyber-essentials-colour.jpg"
                alt="Cyber Essentials"
              />
              <img src="img/partners/google-partner.jpg" alt="Google Partner" />
              <img
                src="img/partners/GBC-colour.png"
                alt="Good Business Charter"
              />
              <img
                src="img/partners/norfolk_prohelp.png"
                alt="Norfolk ProHelp"
              />
              <img
                src="img/partners/investing-in-future-growth.jpg"
                alt="Investing in Future Growth"
              />
              <img
                src="img/partners/norfolk-carbon-charter.jpg"
                alt="Norfolk Carbon Charter"
              />
              <img src="img/partners/PPC_logo.jpg" alt="Prompt Payment Code" />
              <img
                src="img/partners/princess-royal-training.png"
                alt="Princess Royal Training"
              />
              <img src="img/partners/future-50.jpg" alt="Future 50" />
              <img src="img/partners/qms.png" alt="QMS" />
              <img src="img/partners/iso-27001.png" alt="ISO 27001" />
              <img
                src="img/partners/skills-of-tomorrow.jpg"
                alt="Skills of Tomorrow"
              />
            </div>
          </div>
        </section>

        <!-- The "Welcome to Netmatters" section -->
        <section class="welcome">
          <div class="container">
            <!-- A container for the two-column layout -->
            <div class="welcome__menu-container">
              <!-- The left column with introductory text -->
              <div class="welcome__sub-menu-container">
                <h2 class="welcome__heading">Welcome to Netmatters</h2>
                <p class="welcome__paragraph welcome__paragraph--first">
                  Netmatters is a leading <a href="#">Bespoke Software</a>,
                  <a href="#">IT Support</a>, and
                  <a href="#">Digital Marketing</a> company based in the East of
                  England with offices in <a href="#">London</a>,
                  <a href="#">Cambridge</a>, <a href="#">Wymondham</a>, and
                  <a href="#">Great Yarmouth</a>.
                </p>
                <p class="welcome__paragraph">
                  We aren't tied into contracts with third-party providers, so
                  you know that our recommendations for your business are based
                  purely with one benefit in mind: to help improve your business
                  with the most appropriate solutions.
                </p>
                <p class="welcome__paragraph">
                  We pride ourselves on being an ethical business and have a
                  unique business offering and cost model that ensures you get
                  the most from our relationship in an upfront manner.
                </p>
                <!-- Links to "Why Choose Us?" and "Our Culture" pages -->
                <div class="welcome__button-container">
                  <a href="#" class="welcome__button-link"
                    >Why choose us? <span class="icon icon-arrow-right21"></span
                  ></a>
                  <a href="#" class="welcome__button-link"
                    >Our culture <span class="icon icon-arrow-right21"></span
                  ></a>
                </div>
              </div>

              <!-- The right column with client testimonials -->
              <div class="welcome__sub-menu-container">
                <h2 class="welcome__heading">What Our Clients Think</h2>

                <!-- Star rating display -->
                <div class="welcome__stars">
                  <span class="icon icon-star-full"></span>
                  <span class="icon icon-star-full"></span>
                  <span class="icon icon-star-full"></span>
                  <span class="icon icon-star-full"></span>
                  <span class="icon icon-star-full"></span>
                </div>

                <!-- A client testimonial -->
                <blockquote class="welcome__testimonial">
                  <span class="welcome__testimonial-quote">
                    Netmatters stood out from the start. Great guys and very
                    easy to work with. Both the build and digital marketing
                    teams are clearly skilled &mdash; they know their stuff!
                    They delivered a website to our (high!) expectations and
                    went over and above to ensure we were satisfied clients
                    &mdash; and we are!
                  </span>
                  <!-- The author of the testimonial -->
                  <footer class="welcome__testimonial-author no-line-break">
                    <span class="welcome__testimonial-author-name">
                      <cite>Eleanor Bishop</cite>, Head of Marketing
                    </span>
                    <span class="welcome__testimonial-author-organisation">
                      <a href="#">Ashcroft Partnership LLP</a>
                    </span>
                  </footer>
                </blockquote>

                <!-- Links to external review sites -->
                <a
                  href="#"
                  class="welcome__button-link welcome__button-link--google"
                  >Google reviews
                  <span class="icon icon-arrow-right21"></span>
                </a>
                <a
                  href="#"
                  class="welcome__button-link welcome__button-link--trustpilot"
                  >TrustPilot reviews
                  <span class="icon icon-arrow-right21"></span>
                </a>
              </div>
            </div>
          </div>
        </section>

        <section class="news">
          <div class="container">
            <div class="view-more-push-container">
              <h2 class="news__main-header">Latest News</h2>
              <a
                href="#"
                class="news__view-all-link news__view-all-link--wide-viewport"
                >View All
                <span class="icon icon-arrow-right21"></span>
              </a>
            </div>

            <div class="news__menu-container">
              <?php foreach ($newsPosts as $post): ?>
              <section class="news__card">
                <a href="#">
                  <img
                    src="<?php echo htmlspecialchars($post['image']); ?>"
                    alt="<?php echo htmlspecialchars($post['image_alt']); ?>"
                    class="news__card-image"
                  />
                  <div class="news__card-text-container">
                    <h3 class="news__card-title news__card-title--<?php echo htmlspecialchars($post['category_slug']); ?>">
                      <?php echo htmlspecialchars($post['title']); ?>
                    </h3>
                    <span class="news__card-read-length"></span>
                    <p class="news__card-summary">
                      <?php echo htmlspecialchars($post['summary']); ?>
                    </p>
                    <span class="news__card-read-more-button news__card-read-more-button--<?php echo htmlspecialchars($post['category_slug']); ?>">
                      Read More
                    </span>
                    <div class="news__card-author-container">
                      <img
                        src="<?php echo htmlspecialchars($post['author_avatar']); ?>"
                        alt="<?php echo htmlspecialchars($post['author_name']); ?> avatar"
                        class="news__card-avatar"
                      />
                      <div class="news__card-author-text-container">
                        <span class="news__card-posted-by">Posted by <?php echo htmlspecialchars($post['author_name']); ?></span>
                        <time datetime="<?php echo $post['posted_date']; ?>" class="news__card-posted-date">
                          <?php echo News::formatDate($post['posted_date']); ?>
                        </time>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="#" class="news__card-category-label news__card-category-label--<?php echo htmlspecialchars($post['category_slug']); ?>">
                  <?php echo htmlspecialchars($post['category']); ?>
                </a>
              </section>
              <?php endforeach; ?>
            </div>

            <a href="#" class="news__view-all-link news__view-all-link--narrow-viewport">
              View All
              <span class="icon icon-arrow-right21"></span>
            </a>
          </div>
        </section>

        <!-- Section displaying logos of clients -->
        <section class="clients">
          <!-- Uses 'associates-logo-container' for outer styling (hiding overflow) -->
          <div class="associates-logo-container">
            <!-- New unique class for the layout to separate it from Partners JS -->
            <div class="clients-logo-layout-container">
              <!-- Client 1: Searles Leisure Resort -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">
                      Searles Leisure Resort
                    </h3>
                    <p class="clients__pop-up-description">
                      Searles Leisure Resort, on the beautiful North Norfolk
                      coast, is an award-winning UK holiday resort for families.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--green"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img
                  src="img/clients/searles_logo.jpg"
                  alt="Searles Leisure Resort Logo"
                />
              </div>

              <!-- Client 2: Busseys -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Busseys</h3>
                    <p class="clients__pop-up-description">
                      One of the UK's leading Ford dealerships.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--blue"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img src="img/clients/busseys_logo.png" alt="Busseys Logo" />
              </div>

              <!-- Client 3: Crane Garden Buildings -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">
                      Crane Garden Buildings
                    </h3>
                    <p class="clients__pop-up-description">
                      Leading manufacturer and supplier of high-end garden
                      rooms, summerhouses, workshops and sheds in the UK.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--green"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img
                  src="img/clients/crane_logo.png"
                  alt="Crane Garden Buildings Logo"
                />
              </div>

              <!-- Client 4: Black Swan Care Group -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">
                      Black Swan Care Group
                    </h3>
                    <p class="clients__pop-up-description">
                      Black Swan Care Group own and manage 21 high-quality care
                      and residential homes with a focus on putting the needs of
                      their residents first.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--yellow"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img
                  src="img/clients/black_swan_logo.png"
                  alt="Black Swan Care Group Logo"
                />
              </div>

              <!-- Client 5: Xupes -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Xupes</h3>
                  </div>
                </div>
                <img src="img/clients/xupes_logo.png" alt="Xupes Logo" />
              </div>

              <!-- Client 6: Beat -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Beat</h3>
                    <p class="clients__pop-up-description">
                      The UK's eating disorder charity founded in 1989.
                    </p>
                  </div>
                </div>
                <img src="img/clients/beat_logo.png" alt="Beat Logo" />
              </div>

              <!-- Client 7: Survey Solutions -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Survey Solutions</h3>
                  </div>
                </div>
                <img
                  src="img/clients/survey_solutions_logo.png"
                  alt="Survey Solutions Logo"
                />
              </div>

              <!-- Client 8: Girl Guiding Anglia -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Girl Guiding Anglia</h3>
                    <p class="clients__pop-up-description">
                      Girl Guiding Anglia is part of Girlguiding, the UK's
                      leading charity for girls and young women.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--blue"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img
                  src="img/clients/girl_guides_anglia.png"
                  alt="Girl Guiding Anglia Logo"
                />
              </div>

              <!-- Client 9: Sweetzy -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Sweetzy</h3>
                    <p class="clients__pop-up-description">
                      Sweetzy are an online sweets retailer, based in Wymondham.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--green"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img src="img/clients/sweetzy_logo.png" alt="Sweetzy Logo" />
              </div>

              <!-- Client 10: Howes Percival -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">Howes Percival</h3>
                  </div>
                </div>
                <img
                  src="img/clients/howespercivallogo.png"
                  alt="Howes Percival Logo"
                />
              </div>

              <!-- Client 11: GDST -->
              <div class="clients__section-for-each-client">
                <div class="clients__pop-up-hover-container">
                  <div class="clients__pop-up-box">
                    <h3 class="clients__pop-up-heading">GDST</h3>
                    <p class="clients__pop-up-description">
                      The Girls' Day School Trust (GDST) is the UK's leading
                      family of 25 independent girls' schools.
                    </p>
                    <a
                      href="#"
                      class="clients__pop-up-link clients__pop-up-link--blue"
                    >
                      View Our Case Study <span class="triangle"></span>
                    </a>
                  </div>
                </div>
                <img
                  src="img/clients/girls_day_school_trust_logob.png"
                  alt="GDST Logo"
                />
              </div>
            </div>
          </div>
        </section>


        <?php include __DIR__ . '/includes/footer.php'; ?>
      </main>
    </div>
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    <?php include __DIR__ . '/includes/cookies.php'; ?>
    <?php include __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
