import React from 'react'
import familyImg1 from '../public/famillePhotos/familyImg1.jpg'
import familyImg2 from '../public/famillePhotos/familyImg2.jpg'
import familyImg3 from '../public/famillePhotos/familyImg3.jpg'
import familyImg4 from '../public/famillePhotos/familyImg4.jpg'
import familyImg5 from '../public/famillePhotos/familyImg5.jpg'
import familyImg6 from '../public/famillePhotos/familyImg6.jpg'
import familyImg7 from '../public/famillePhotos/familyImg7.jpg'
import familyImg8 from '../public/famillePhotos/familyImg8.jpg'
import FamilyGalleryImg from './FamilyGalleryImg'

const FamilyGallery = () => {
  return (
    <div className='max-w-[1240px] mx-auto text-center py-32'>
        <h1 className='textLibre text-2xl font-bold pb-2'>Galerie photo de famille</h1>
        <div className='grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 p-4'>
            <FamilyGalleryImg familyImg={familyImg1} />
            <FamilyGalleryImg familyImg={familyImg2} />
            <FamilyGalleryImg familyImg={familyImg3} />
            <FamilyGalleryImg familyImg={familyImg4} />
            <FamilyGalleryImg familyImg={familyImg5} />
            <FamilyGalleryImg familyImg={familyImg6} />
            <FamilyGalleryImg familyImg={familyImg7} />
            <FamilyGalleryImg familyImg={familyImg8} />
        </div>
    </div>
  )
}

export default FamilyGallery