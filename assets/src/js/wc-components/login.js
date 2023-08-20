document.addEventListener("DOMContentLoaded", function () {
  const loginLink = document.querySelector(".back-login-link");
  const signupLink = document.querySelector(".signup-link");

  const loginForm = document.querySelector(
    ".entry-content.account-reg #customer_login .u-column1"
  );
  const registrationForm = document.querySelector(
    ".entry-content.account-reg #customer_login .u-column2"
  );

  function handleLoginLinkClick(e) {
    e.preventDefault();
    const parentContainer = this.parentNode;
    parentContainer.style.display = "none";
    signupLink.parentNode.style.display = "block";
    loginForm.style.display = "block";
    registrationForm.style.display = "none";
  }

  function handleSignupLinkClick(e) {
    e.preventDefault();
    const parentContainer = this.parentNode;
    parentContainer.style.display = "none";
    loginLink.parentNode.style.display = "block";
    // parentContainer.style.display = "none";
    loginForm.style.display = "none";
    registrationForm.style.display = "block";
  }

  if (loginLink && signupLink && loginForm && registrationForm) {
    loginLink.addEventListener("click", handleLoginLinkClick);
    signupLink.addEventListener("click", handleSignupLinkClick);
  }
});

jQuery(document).ready(function ($) {
  // Add the show-password-input span with SVG icons to password fields
  $(".password-input").each(function () {
    $(this).append(
      '<span class="show-password-input-custom">' +
        '<svg width="16" height="16" aria-hidden="true"><use href="#eye-icon"></use></svg>' +
        '<svg width="16" height="16" aria-hidden="true" style="display:none;"><use href="#eye-slash-icon"></use></svg>' +
        "</span>"
    );
  });

  // Toggle password visibility
  $(".show-password-input-custom").on("click", function () {
    const passwordField = $(this).siblings(
      '.woocommerce-Input--password, input[name="password"]'
    );
    // const passwordField = $(this).siblings('input[name="password"]');
    const eyeIcons = $(this).find("svg");

    if (passwordField.prop("type") === "password") {
      passwordField.prop("type", "text");
      eyeIcons.eq(0).hide();
      eyeIcons.eq(1).show();
    } else {
      passwordField.prop("type", "password");
      eyeIcons.eq(1).hide();
      eyeIcons.eq(0).show();
    }
  });
});
