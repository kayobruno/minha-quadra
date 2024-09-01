import { CustomerSerive } from '../customers/customerService.ts';

export class CustomerAutocompleteService {
  private inputField: HTMLInputElement;
  private resultsContainer: HTMLElement;
  private timeoutId: NodeJS.Timeout;
  private debounceTime: number;
  private onSelect: (suggestion: { name: string, phone: string, id: number }) => void;

  constructor(
    inputFieldId: string,
    resultsContainerId: string,
    onSelect: (suggestion: { name: string, phone: string, id: number }) => void,
    debounceTime: number = 300
  ) {
    this.inputField = document.getElementById(inputFieldId) as HTMLInputElement;
    this.resultsContainer = document.getElementById(resultsContainerId) as HTMLElement;
    this.debounceTime = debounceTime;
    this.onSelect = onSelect;
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

      if (Array.isArray(suggestions) && suggestions.length > 0) {
        suggestions.forEach(suggestion => {
          const suggestionElement = document.createElement('div');
          suggestionElement.textContent = suggestion.name + (suggestion.phone ? ' - ' + suggestion.phone : '');
          suggestionElement.classList.add('suggestion');
          this.resultsContainer.appendChild(suggestionElement);

          suggestionElement.addEventListener('click', () => {
            this.handleSelect(suggestion);
          });
        });
      }
    }
  }

  private handleSelect(suggestion: { name: string, phone: string, id: number }): void {
    if (this.onSelect) {
      this.onSelect(suggestion);
    }
  }
}
