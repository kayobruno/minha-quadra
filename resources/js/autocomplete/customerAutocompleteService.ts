import { CustomerSerive } from '../customers/customerService.ts';

export class CustomerAutocompleteService {
    
  private inputField: HTMLInputElement;
  private resultsContainer: HTMLElement;
  private timeoutId: NodeJS.Timeout;
  private debounceTime: number;

  constructor(inputFieldId: string, resultsContainerId: string, debounceTime: number = 300) {
    this.inputField = document.getElementById(inputFieldId) as HTMLInputElement;
    this.resultsContainer = document.getElementById(resultsContainerId) as HTMLElement;
    this.debounceTime = debounceTime;
    this.initialize();
  }

  private initialize(): void {
    this.inputField.addEventListener('input', (event) => {
      const query = this.inputField.value;
      this.updateAutocompleteResultsDebounced(query);
    });
  }

  private updateAutocompleteResultsDebounced(query: string): void {
    clearTimeout(this.timeoutId);
    this.timeoutId = setTimeout(() => {
      this.updateAutocompleteResults(query);
    }, this.debounceTime);
  }

  private async updateAutocompleteResults(query: string): Promise<void> {
    this.resultsContainer.innerHTML = '';

    if (query.length >= 3) {
      const suggestions = await CustomerSerive.getCustomerByName(query);

      suggestions.forEach(suggestion => {
        const suggestionElement = document.createElement('div');
        suggestionElement.textContent = suggestion.name + (suggestion.phone ? ' - ' + suggestion.phone : '');
        suggestionElement.classList.add('suggestion');
        this.resultsContainer.appendChild(suggestionElement);

        suggestionElement.addEventListener('click', () => {
          this.selectSuggestion(suggestion);
        });
      });
    }
  }

  private selectSuggestion(suggestion: { name: string, phone: string, id: number }): void {
    this.inputField.value = suggestion.name;

    document.getElementById('phone').value = suggestion.phone;
    document.getElementById('customer_id').value = suggestion.id.toString();

    this.resultsContainer.innerHTML = '';
  }
}
