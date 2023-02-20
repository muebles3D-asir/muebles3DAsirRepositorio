import { InMemoryDbService } from 'angular-in-memory-web-api';

export class FurnitureData implements InMemoryDbService {
  createDb() {
    let furnitures = [
      {
        id: 0,
        name: 'First Furniture',
        price: 24.99,
        rating: 4.3,
        shortDescription: 'This is a short description of the First Furniture',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        image: 'https://picsum.photos/820/300',
        categories: ['electronics', 'hardware'],
      },
      {
        id: 1,
        name: 'Second Furniture',
        price: 64.99,
        rating: 3.5,
        shortDescription: 'This is a short description of the Second Furniture',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        image: 'https://picsum.photos/820/300',
        categories: ['books'],
      },
      {
        id: 2,
        name: 'Third Furniture',
        price: 74.99,
        rating: 4.2,
        shortDescription: 'This is a short description of the Third Furniture',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        image: 'https://picsum.photos/820/300',
        categories: ['electronics'],
      },
      {
        id: 3,
        name: 'Fourth Furniture',
        price: 84.99,
        rating: 3.9,
        shortDescription: 'This is a short description of the Fourth Furniture',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        image: 'https://picsum.photos/820/300',
        categories: ['hardware'],
      },
      {
        id: 4,
        name: 'Fifth Furniture',
        price: 94.99,
        rating: 5,
        shortDescription: 'This is a short description of the Fifth Furniture',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        image: 'https://picsum.photos/820/300',
        categories: ['electronics', 'hardware'],
      },
      {
        id: 5,
        name: 'Sixth Furniture',
        price: 54.99,
        rating: 4.6,
        shortDescription: 'This is a short description of the Sixth Furniture',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        image: 'https://picsum.photos/820/300',
        categories: ['books'],
      },
    ];
    return { furnitures: furnitures };
  }
}
