<?php
/**
 * Contact Us Page - Netmatters
 */
require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/classes/Contact.php';

$pageTitle = 'Contact Us';

// Initialize variables
$formData = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'company' => '',
    'message' => '',
    'marketing_consent' => false
];
$errors = [];
$success = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'company' => trim($_POST['company'] ?? ''),
        'message' => trim($_POST['message'] ?? ''),
        'marketing_consent' => isset($_POST['marketing_consent'])
    ];
    
    try {
        $db = Database::getInstance();
        $contact = new Contact($db->getConnection());
        
        if ($contact->validate($formData)) {
            if ($contact->save($formData)) {
                $success = true;
                $formData = [
                    'name' => '',
                    'email' => '',
                    'phone' => '',
                    'company' => '',
                    'message' => '',
                    'marketing_consent' => false
                ];
            } else {
                $errors['general'] = 'There was an error submitting your message. Please try again.';
            }
        } else {
            $errors = $contact->getErrors();
        }
    } catch (PDOException $e) {
        $errors['general'] = 'Database error. Please try again later.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include __DIR__ . '/includes/head.php'; ?>
    <link rel="stylesheet" href="dist/style.css" />
  </head>
  <body>
    <div id="container">
      <?php include __DIR__ . '/includes/header.php'; ?>

      <main>
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
          <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
              <a href="index.php" class="breadcrumb__link">Home</a>
              <span class="breadcrumb__separator">/</span>
              <span class="breadcrumb__current">Our Offices</span>
            </nav>
          </div>
        </div>

        <!-- Office Cards Section -->
        <section class="offices">
          <div class="container">
            <h1 class="offices__title">Our Offices</h1>
            
            <div class="offices__grid">
              <!-- Cambridge Office -->
              <div class="office-card">
                <div class="office-card__image">
                  <img src="img/contact/cambridge.jpg" alt="Cambridge Office">
                </div>
                <div class="office-card__content">
                  <h2 class="office-card__name">Cambridge Office</h2>
                  <address class="office-card__address">
                    Unit 1.31,<br>
                    St John's Innovation Centre,<br>
                    Cowley Road, Milton,<br>
                    Cambridge,<br>
                    CB4 0WS
                  </address>
                  <a href="tel:01223375772" class="office-card__phone">01223 37 57 72</a>
                  <a href="#" class="office-card__btn">View More</a>
                </div>
              </div>

              <!-- Wymondham Office -->
              <div class="office-card">
                <div class="office-card__image">
                  <img src="img/contact/wymondham.jpg" alt="Wymondham Office">
                </div>
                <div class="office-card__content">
                  <h2 class="office-card__name">Wymondham Office</h2>
                  <address class="office-card__address">
                    Unit 15,<br>
                    Penfold Drive,<br>
                    Gateway 11 Business Park,<br>
                    Wymondham, Norfolk,<br>
                    NR18 0WZ
                  </address>
                  <a href="tel:01603704020" class="office-card__phone">01603 70 40 20</a>
                  <a href="#" class="office-card__btn">View More</a>
                </div>
              </div>

              <!-- Great Yarmouth Office -->
              <div class="office-card">
                <div class="office-card__image">
                  <img src="img/contact/yarmouth-2.jpg" alt="Great Yarmouth Office">
                </div>
                <div class="office-card__content">
                  <h2 class="office-card__name">Great Yarmouth Office</h2>
                  <address class="office-card__address">
                    Suite F23,<br>
                    Beacon Innovation Centre,<br>
                    Beacon Park, Gorleston,<br>
                    Great Yarmouth, Norfolk,<br>
                    NR31 7RA
                  </address>
                  <a href="tel:01493603204" class="office-card__phone">01493 60 32 04</a>
                  <a href="#" class="office-card__btn">View More</a>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Contact Form & Info Section -->
        <section class="contact">
          <div class="container">
            <div class="contact__grid">
              
              <!-- Left Column - Contact Form -->
              <div class="contact__form-wrapper">
                <?php if ($success): ?>
                <div class="alert alert--success">
                  <strong>Thank you for your message!</strong>
                  <p>We have received your enquiry and will get back to you within 24 hours.</p>
                </div>
                <?php endif; ?>
                
                <?php if (isset($errors['general'])): ?>
                <div class="alert alert--error">
                  <?php echo htmlspecialchars($errors['general']); ?>
                </div>
                <?php endif; ?>

                <form id="contact-form" class="contact-form" method="POST" action="contact-us.php" novalidate>
                  <!-- Row 1: Name & Company -->
                  <div class="contact-form__row">
                    <div class="form-group <?php echo isset($errors['name']) ? 'form-group--error' : ''; ?>">
                      <label for="name" class="form-label">
                        Your Name <span class="required">*</span>
                      </label>
                      <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input"
                        value="<?php echo htmlspecialchars($formData['name']); ?>"
                        required
                        minlength="2"
                      />
                      <?php if (isset($errors['name'])): ?>
                      <span class="form-error"><?php echo htmlspecialchars($errors['name']); ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="company" class="form-label">Company Name</label>
                      <input 
                        type="text" 
                        id="company" 
                        name="company" 
                        class="form-input"
                        value="<?php echo htmlspecialchars($formData['company']); ?>"
                      />
                    </div>
                  </div>

                  <!-- Row 2: Email & Phone -->
                  <div class="contact-form__row">
                    <div class="form-group <?php echo isset($errors['email']) ? 'form-group--error' : ''; ?>">
                      <label for="email" class="form-label">
                        Your Email <span class="required">*</span>
                      </label>
                      <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input"
                        value="<?php echo htmlspecialchars($formData['email']); ?>"
                        required
                      />
                      <?php if (isset($errors['email'])): ?>
                      <span class="form-error"><?php echo htmlspecialchars($errors['email']); ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group <?php echo isset($errors['phone']) ? 'form-group--error' : ''; ?>">
                      <label for="phone" class="form-label">
                        Your Telephone Number <span class="required">*</span>
                      </label>
                      <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="form-input"
                        value="<?php echo htmlspecialchars($formData['phone']); ?>"
                        required
                      />
                      <?php if (isset($errors['phone'])): ?>
                      <span class="form-error"><?php echo htmlspecialchars($errors['phone']); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Row 3: Message -->
                  <div class="form-group <?php echo isset($errors['message']) ? 'form-group--error' : ''; ?>">
                    <label for="message" class="form-label">
                      Message <span class="required">*</span>
                    </label>
                    <textarea 
                      id="message" 
                      name="message" 
                      class="form-textarea"
                      required
                      minlength="10"
                      rows="6"
                      placeholder="Hi, I am interested in discussing a Our Offices solution, could you please give me a call or send an email?"
                    ><?php echo htmlspecialchars($formData['message']); ?></textarea>
                    <?php if (isset($errors['message'])): ?>
                    <span class="form-error"><?php echo htmlspecialchars($errors['message']); ?></span>
                    <?php endif; ?>
                  </div>

                  <!-- Marketing Consent -->
                  <div class="form-group form-group--checkbox">
                    <label class="checkbox-label">
                      <input 
                        type="checkbox" 
                        name="marketing_consent" 
                        class="form-checkbox"
                        <?php echo $formData['marketing_consent'] ? 'checked' : ''; ?>
                      />
                      <span class="checkbox-custom"></span>
                      <span class="checkbox-text">
                        Please tick this box if you wish to receive marketing information from us.
                        Please see our <a href="#">Privacy Policy</a> for more information on how we keep your data safe.
                      </span>
                    </label>
                  </div>

                  <p class="form-recaptcha">
                    This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a> apply.
                  </p>

                  <!-- Submit Button -->
                  <div class="contact-form__footer">
                    <button type="submit" class="btn btn--primary">
                      Send Enquiry
                    </button>
                    <span class="form-note"><span class="required">*</span> Fields Required</span>
                  </div>
                </form>
              </div>

              <!-- Right Column - Contact Info -->
              <div class="contact__info">
                <p class="contact-info__label">Email us on:</p>
                <a href="mailto:sales@netmatters.com" class="contact-info__email">sales@netmatters.com</a>
                
                <p class="contact-info__label">Business hours:</p>
                <p class="contact-info__hours">Monday - Friday 07:00 - 18:00</p>

                <!-- Out of Hours Accordion -->
                <button class="accordion-trigger" aria-expanded="false" aria-controls="out-of-hours-content">
                  <span class="accordion-trigger__text">Out of Hours IT Support</span>
                  <span class="accordion-trigger__arrow">
                    <span class="icon icon-angle-down"></span>
                  </span>
                </button>
                <div id="out-of-hours-content" class="accordion-content" hidden>
                  <p>Netmatters IT are offering an Out of Hours service for Emergency and Critical tasks.</p>
                  <div class="accordion-content__hours">
                    <div class="hours-row"><strong>Monday - Friday 18:00 - 22:00 Saturday</strong></div>
                    <div class="hours-row">08:00 - 16:00</div>
                    <div class="hours-row"><strong>Sunday</strong> 10:00 - 18:00</div>
                  </div>
                  <p>To log a critical task, you will need to call our main line number and select Option 2 to leave an Out of Hours voicemail. A technician will contact you on the number provided within 45 minutes of your call.</p>
                </div>
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
    <script src="app/js/contact.js"></script>
  </body>
</html>
