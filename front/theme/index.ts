import { extendTheme } from '@chakra-ui/react'

const theme = extendTheme({
  styles: {
    global: {
      body: {
        bg: 'white',
        color: 'gray.800',
      },
    },
  },
  fonts: {
    heading: 'var(--font-libre)',
    body: 'var(--font-inter)',
  },
  colors: {
    brand: {
      50: '#f5f5f5',
      100: '#e0e0e0',
      500: '#111111',
      700: '#000000',
    },
  },
})

export default theme