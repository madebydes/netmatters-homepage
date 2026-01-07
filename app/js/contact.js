/**
 * Contact Page JavaScript
 * - Form validation (client-side)
 * - Accordion functionality
 */

document.addEventListener('DOMContentLoaded', function() {
  'use strict';

  // ===========================================
  // ACCORDION FUNCTIONALITY
  // ===========================================
  
  function initAccordion() {
    const accordionTriggers = document.querySelectorAll('.accordion-trigger');
    
    // Ensure all accordion content is hidden on page load
    document.querySelectorAll('.accordion-content').forEach(content => {
      content.style.display = 'none';
    });
    
    accordionTriggers.forEach(trigger => {
      trigger.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        const content = document.getElementById(this.getAttribute('aria-controls'));
        
        // Toggle the accordion
        this.setAttribute('aria-expanded', !isExpanded);
        
        if (isExpanded) {
          // Close the accordion
          content.style.display = 'none';
          content.setAttribute('hidden', '');
          this.classList.remove('accordion-trigger--active');
        } else {
          // Open the accordion
          content.style.display = 'block';
          content.removeAttribute('hidden');
          this.classList.add('accordion-trigger--active');
        }
      });
    });
  }

  // ===========================================
  // FORM VALIDATION
  // ===========================================
  
  const validators = {
    required: function(value) {
      return value.trim() !== '';
    },
    
    minLength: function(value, length) {
      return value.trim().length >= length;
    },
    
    email: function(value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(value.trim());
    },
    
    phone: function(value) {
      if (value.trim() === '') return false;
      const phoneRegex = /^[\d\s\-+()]{10,}$/;
      return phoneRegex.test(value.trim());
    }
  };

  const errorMessages = {
    name: {
      required: 'Please enter your name',
      minLength: 'Name must be at least 2 characters'
    },
    email: {
      required: 'Please enter your email address',
      email: 'Please enter a valid email address'
    },
    phone: {
      required: 'Please enter your telephone number',
      phone: 'Please enter a valid telephone number'
    },
    message: {
      required: 'Please enter your message',
      minLength: 'Message must be at least 10 characters'
    }
  };

  function showError(field, message) {
    const formGroup = field.closest('.form-group');
    if (!formGroup) return;
    
    formGroup.classList.add('form-group--error');
    
    const existingError = formGroup.querySelector('.form-error');
    if (existingError) {
      existingError.remove();
    }
    
    const errorSpan = document.createElement('span');
    errorSpan.className = 'form-error';
    errorSpan.textContent = message;
    formGroup.appendChild(errorSpan);
  }

  function clearError(field) {
    const formGroup = field.closest('.form-group');
    if (!formGroup) return;
    
    formGroup.classList.remove('form-group--error');
    
    const existingError = formGroup.querySelector('.form-error');
    if (existingError) {
      existingError.remove();
    }
  }

  function validateField(field) {
    const name = field.name;
    const value = field.value;
    
    if (!errorMessages[name]) {
      return true;
    }
    
    if (field.hasAttribute('required') && !validators.required(value)) {
      showError(field, errorMessages[name].required);
      return false;
    }
    
    const minLength = field.getAttribute('minlength');
    if (minLength && !validators.minLength(value, parseInt(minLength))) {
      showError(field, errorMessages[name].minLength);
      return false;
    }
    
    if (field.type === 'email' && value.trim() !== '' && !validators.email(value)) {
      showError(field, errorMessages[name].email);
      return false;
    }
    
    if (field.type === 'tel' && !validators.phone(value)) {
      showError(field, errorMessages[name].phone || errorMessages[name].required);
      return false;
    }
    
    clearError(field);
    return true;
  }

  function initFormValidation() {
    const form = document.getElementById('contact-form');
    if (!form) return;
    
    const fieldsToValidate = form.querySelectorAll('input[name], textarea[name]');
    
    fieldsToValidate.forEach(field => {
      field.addEventListener('blur', function() {
        validateField(this);
      });
      
      field.addEventListener('input', function() {
        if (this.closest('.form-group').classList.contains('form-group--error')) {
          validateField(this);
        }
      });
    });
    
    form.addEventListener('submit', function(e) {
      let isValid = true;
      let firstInvalidField = null;
      
      fieldsToValidate.forEach(field => {
        if (!validateField(field)) {
          isValid = false;
          if (!firstInvalidField) {
            firstInvalidField = field;
          }
        }
      });
      
      if (!isValid) {
        e.preventDefault();
        if (firstInvalidField) {
          firstInvalidField.focus();
        }
      }
    });
  }

  // ===========================================
  // INITIALIZE
  // ===========================================
  
  initAccordion();
  initFormValidation();
});
