import React from 'react'
import newbornImg1 from '../public/newbornPhotos/newbornImg1.jpg'
import newbornImg2 from '../public/newbornPhotos/newbornImg2.jpg'
import newbornImg3 from '../public/newbornPhotos/newbornImg3.jpg'
import newbornImg4 from '../public/newbornPhotos/newbornImg4.jpg'
import newbornImg5 from '../public/newbornPhotos/newbornImg5.jpg'
import newbornImg6 from '../public/newbornPhotos/newbornImg6.jpg'
import newbornImg7 from '../public/newbornPhotos/newbornImg7.jpg'
import newbornImg8 from '../public/newbornPhotos/newbornImg8.jpg'
import newbornImg9 from '../public/newbornPhotos/newbornImg9.jpg'
import newbornImg10 from '../public/newbornPhotos/newbornImg10.jpg'
import NewbornGalleryImg from './NewbornGalleryImg'

const NewbornGallery = () => {
  return (
    <div className='max-w-[1240px] mx-auto text-center py-32'>
        <h1 className='textLibre text-2xl font-bold pb-2'>Galerie photo de nouveau-né</h1>
        <div className='grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 p-4'>
            <NewbornGalleryImg newbornImg={newbornImg1} />
            <NewbornGalleryImg newbornImg={newbornImg2} />
            <NewbornGalleryImg newbornImg={newbornImg3} />
            <NewbornGalleryImg newbornImg={newbornImg4} />
            <NewbornGalleryImg newbornImg={newbornImg5} />
            <NewbornGalleryImg newbornImg={newbornImg6} />
            <NewbornGalleryImg newbornImg={newbornImg7} />
            <NewbornGalleryImg newbornImg={newbornImg8} />
            <NewbornGalleryImg newbornImg={newbornImg9} />
            <NewbornGalleryImg newbornImg={newbornImg10} />
        </div>
    </div>
  )
}

export default NewbornGallery