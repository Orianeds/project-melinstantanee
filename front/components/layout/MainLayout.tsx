'use client'

import { Box, Container } from '@chakra-ui/react'
import Navbar from '@/components/Navbar'
import Footer from '@/components/Footer'

export default function MainLayout({ children }: { children: React.ReactNode }) {
  return (
    <Box minH="100vh" display="flex" flexDirection="column">
      <Navbar />

      <Container maxW="1200px" flex="1" py={10}>
        {children}
      </Container>

      <Footer />
    </Box>
  )
}