import { render, screen } from '@testing-library/react';
import Home from '../components/Home';

test('links', () => {
    render(<Home />);

    const links = screen.getAllByRole('link');
    links.forEach(element => {
        expect(element).toBeVisible();
    });
});