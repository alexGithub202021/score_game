import { render, screen } from '@testing-library/react';
import Summary from '../components/Summary';

test('links', () => {
    render(<Summary />);

    const linkElement = screen.getByRole('button');
    expect(linkElement).toBeInTheDocument();

    const input = screen.getByRole('textbox');
    expect(input).toBeInTheDocument();

    const text = screen.getByText(/Summary/i);
    expect(text).toBeInTheDocument();
});