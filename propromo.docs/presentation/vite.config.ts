import { defineConfig } from 'vite';

export default defineConfig({
  plugins: [
    {
      name: 'append-time-query',
      configureServer(server) {
        server.middlewares.use((req, res, next) => {
          // Determine the protocol (http or https)
          const protocol = req.headers['x-forwarded-proto'] || 'http'; // Fallback to 'http' if not set
          const url = new URL(req.url, `${protocol}://${req.headers.host}`);
          
          // Regular expression to match paths like /1, /123, or / with or without a query string
          const numberPathPattern = /^\/\d+$/; // Match /<number>
          const rootPathPattern = /^\/$/; // Match /

          // Check if the path matches a number path or the root path
          if (
            (numberPathPattern.test(url.pathname) || rootPathPattern.test(url.pathname)) &&
            !url.searchParams.has('time')
          ) {
            // Append the time query parameter while preserving existing ones (has to be 8-10 minutes, @see https://leowiki.htl-leonding.ac.at/doku.php?id=competitions:project-award)
            url.searchParams.set('time', '8');
            
            // Redirect with the updated URL and preserve any existing query parameters
            res.writeHead(302, { Location: url.toString() });
            res.end();
          } else {
            next();
          }
        });
      },
    },
  ],
});
