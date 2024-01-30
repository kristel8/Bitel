export function validateForm(form) {
  for (const control of form) {
      control.addEventListener("keyup", () => {
        const validator = control.validity;

          if (validator.patternMismatch) {
              control.classList.add('error');
              return;
          }

          control.classList.remove('error');
      });
  }
}