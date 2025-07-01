import { defineConfig } from 'vitest/config';


export default defineConfig({
    test: {
        globals: true,
        setupFiles: ['./resources/js/tests/setup_files/mock_server_calls.ts'],
    },
});
