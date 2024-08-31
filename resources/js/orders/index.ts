import { CustomerAutocompleteService } from '../autocomplete/customerAutocompleteService.ts';

function clearCustomerInput(): void {
  const customerInput = document.getElementById('customer') as HTMLInputElement;
  const customerIdInput = document.getElementById('customer_id') as HTMLInputElement;
  const saveButton = document.getElementById('save-order') as HTMLButtonElement;
  const phone = document.getElementById('phone') as HTMLButtonElement;
  
  saveButton.disabled = true;
  customerInput.value = '';
  customerIdInput.value = '';
  phone.value = '';
}

function initialize(): void {
  const handleCustomerSelect = (suggestion: { name: string, phone: string, id: number }) => {
    document.getElementById('phone').value = suggestion.name;
    document.getElementById('phone').value = suggestion.phone;
    document.getElementById('customer_id').value = suggestion.id.toString();
    document.getElementById('autocomplete-results').innerHTML = '';

    const saveButton = document.getElementById('save-order') as HTMLButtonElement;
    saveButton.disabled = false;
  };

  const autocomplete = new CustomerAutocompleteService(
    'customer',
    'autocomplete-results',
    handleCustomerSelect
  );

  const modalElement = document.getElementById('basicModal');
  if (modalElement) {
    modalElement.addEventListener('hidden.bs.modal', clearCustomerInput);
  }

  const saveButton = document.getElementById('save-order') as HTMLButtonElement;
  saveButton.disabled = true;

  const customerInput = document.getElementById('customer') as HTMLButtonElement;
  customerInput.addEventListener('change', function() {
    saveButton.disabled = this.value.trim() === '';
    document.getElementById('customer_id').value = '';
    document.getElementById('phone').value = '';
  });
}

document.addEventListener('DOMContentLoaded', initialize);
