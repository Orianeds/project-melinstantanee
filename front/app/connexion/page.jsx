'use client'

import { Box, Button, Text, VStack } from '@chakra-ui/react'

export default function Connexion() {
  return (
    <Box p={10}>
      <VStack spacing={4} align="start">
        <Text fontSize="2xl">Test Chakra UI OK</Text>
        <Button colorScheme="blue">Se connecter</Button>
      </VStack>
    </Box>
  )
}