import { CustomerAutocompleteService } from '../autocomplete/customerAutocompleteService.ts';

document.addEventListener('DOMContentLoaded', () => {
  const autocomplete = new CustomerAutocompleteService('customer', 'autocomplete-results');
});
