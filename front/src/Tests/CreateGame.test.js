import { render, screen } from '@testing-library/react';
import CreateGame from '../components/CreateGame';

test('links', () => {
    render(<CreateGame />);

    const cells = screen.getAllByRole('cell');
    cells.forEach(element => {
        expect(element).toBeVisible();
    });

    const buttons = screen.getAllByRole('button');
    buttons.forEach(element => {
        expect(element).toBeVisible();
    });

    const text = screen.getByText(/Create a football game/i);
    expect(text).toBeInTheDocument();
});