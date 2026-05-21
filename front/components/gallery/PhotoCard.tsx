'use client'

import {
  Box,
  Image,
  Text,
} from '@chakra-ui/react'

type PhotoCardProps = {
  imageUrl: string
  title?: string
  onClick?: () => void
}

export default function PhotoCard({
  imageUrl,
  title,
  onClick,
}: PhotoCardProps) {
  return (
    <Box
      cursor="pointer"
      overflow="hidden"
      borderRadius="xl"
      onClick={onClick}
      transition="0.3s"
      _hover={{
        transform: 'scale(1.02)',
      }}
    >
      <Image
        src={imageUrl}
        alt={title || 'Photo'}
        objectFit="cover"
        w="100%"
        h="100%"
      />

      {title && (
        <Text mt={2} fontSize="sm">
          {title}
        </Text>
      )}
    </Box>
  )
}