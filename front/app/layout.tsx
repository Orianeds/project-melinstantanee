import type { Metadata } from 'next'
import { Libre_Caslon_Display, Inter } from 'next/font/google'
import { Providers } from './providers'
import './globals.css'

const libreCaslonDisplay = Libre_Caslon_Display({ 
  weight: '400',
  subsets: ['latin'],
  variable: "--font-libre",
});

const inter = Inter({
  subsets: ['latin'],
  variable: "--font-inter",
});

export const metadata: Metadata = {
  title: 'Mélinstantée - Photographe',
  description: 'Portfolio et galerie client',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="fr" className={`${libreCaslonDisplay.variable} ${inter.variable}`}>
      <body>
        <Providers>{children}</Providers>
      </body>
    </html>
  )
}
