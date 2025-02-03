import { defineMiddleware } from 'astro:middleware';

// temporarily redirect .md and .mdx files, because `starlight-blog` doesn't support astro 5 fully yet
export const onRequest = defineMiddleware(async (context, next) => {
  const url = new URL(context.request.url);
  if (url.pathname.endsWith('.md') || url.pathname.endsWith('.mdx')) {
    const newPath = url.pathname.replace(/\.(md|mdx)$/, '');
    return context.redirect(newPath);
  }
  return next();
});
